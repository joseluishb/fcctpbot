<?php

namespace App\Services;

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
}
