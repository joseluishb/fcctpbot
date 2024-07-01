<?php

namespace App\Services;

use App\Models\SapM\TempMatricula;

class ConditionEvaluatorService
{
    /**
     * Evaluar las condiciones definidas en el JSON.
     *
     * @param string $conditionsJson
     * @param string $codEsc
     * @param int $ciclo
     * @return int|null
     */
    public function evaluateConditions($conditionsJson, $codEsc, $ciclo)
    {
        $conditions = json_decode($conditionsJson, true);

        if (!isset($conditions['conditions'])) {
            return null;
        }

        foreach ($conditions['conditions'] as $condition) {
            $allRulesMet = true;

            foreach ($condition['rules'] as $rule) {
                $field = $rule['field'];
                $value = $rule['value'];

                if ($field === 'cod_esc') {
                    if ($codEsc != $value) {
                        $allRulesMet = false;
                        break;
                    }
                } elseif ($field === 'ciclo') {
                    if (is_array($value)) {
                        if (!($ciclo >= (int)$value[0] && $ciclo <= (int)$value[1])) {
                            $allRulesMet = false;
                            break;
                        }
                    } else {
                        if ($ciclo != $value) {
                            $allRulesMet = false;
                            break;
                        }
                    }
                }
            }

            if ($allRulesMet) {
                return $condition['next_option_id'];
            }
        }

        return null;
    }


    public function execInternalProcess($optionForExecProcess, $clienteTempMat)
    {
        $optionRoute = $optionForExecProcess->condiciones;

        $conditions = json_decode($optionRoute, true);

        if (!isset($conditions['action'])) {
            return null;
        }

        if ($conditions['action'] === 'FORNEXTOPTIONID' ) {
            $codEsc = $clienteTempMat->cod_esc;
            $ciclo = (int) $clienteTempMat->ciclo;

            $nextOptionId = $this->evaluateConditions($optionRoute, $codEsc, $ciclo);
            return [$conditions['action'], $nextOptionId];
        }

        if ($conditions['action'] === 'GETAVERAGE') {
            $codEsc = $clienteTempMat->cod_esc;
            $promSem = $clienteTempMat->prom_sem;

            return [$conditions['action'], $promSem];
        }


    }



    public function getClienteTempMatricula($nroDoc)
    {
        return TempMatricula::where('dni', $nroDoc)->where('estado', '1')->first();
    }


}
