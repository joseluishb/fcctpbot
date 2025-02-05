<?php

namespace App\Services;

use App\Mail\SemesterAverageDispatch;
use App\Models\BotMailSended;
use App\Models\SapM\CronogramaMatricula;
use App\Models\SapM\TempMatricula;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

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



        $promSem = null;
        if ($conditions['action'] === 'GETAVERAGE' && $clienteTempMat->modalidad === 'REGULAR') {

            $codEsc = $clienteTempMat->cod_esc;
            $promSem = $clienteTempMat->prom_sem;

            $em = $clienteTempMat->mail_inst;
            $action = "GETAVERAGE";

            //TODO:: ENVIAR X CORREO
            $recordExists = BotMailSended::where('em', $em)
                                            ->where('action', $action)->exists();

            if (!$recordExists) {
                Mail::to($em)->send(new SemesterAverageDispatch($clienteTempMat));

                BotMailSended::create([
                    'action' => $action,
                    'em' => $em,
                ]);
            }

            return [$conditions['action'], $promSem];
        }

        if ($conditions['action'] === 'FORREPLYEXTEMP') {
            $codEsc = $clienteTempMat->cod_esc;

            $nextOptionId = $this->getReplyForMatExtemporanea($optionRoute, $codEsc);
            return [$conditions['action'], $nextOptionId];
        }

        if ($conditions['action'] === 'FORAMPLMATRICULA') {
            $ampCred = $clienteTempMat->amp_cred;
            $ciclo = (int) $clienteTempMat->ciclo;

            $nextOptionId = $this->getEvalForAmpliacionCreditos($optionRoute, $ampCred, $ciclo);

            return [$conditions['action'], $nextOptionId];
        }

        if ($conditions['action'] === 'FORREPLYLINKZOOM') {
            $codEsc = $clienteTempMat->cod_esc;

            $nextOptionId = $this->getReplyForLinkZoon($optionRoute, $codEsc);
            //dd($nextOptionId);
            //dd([$conditions['action'], $nextOptionId]);
            return [$conditions['action'], $nextOptionId];
        }
    }

    public function getReplyForMatExtemporanea($conditionsJson, $codEsc)
    {
        $currentDate = Carbon::today();
        $codPer = '2025-1';

        $conditions = json_decode($conditionsJson, true);

        if (!isset($conditions['conditions'])) {
            return null;
        }

        $cronoMatr = CronogramaMatricula::where('codper', $codPer)
                                        ->where('nivel', 'PREGRADO')
                                        ->where('fec_ini_mat_ext', '<=', $currentDate)
                                        ->where('fec_fin_mat_ext', '>=', $currentDate)
                                        ->first();
        //dd($cronoMatr);

        if(!$cronoMatr){
            return (int) $conditions['option_default'];
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
                }
            }

            if ($allRulesMet) {
                return $condition['next_option_id'];
            }
        }

        return null;
    }
    public function getReplyForLinkZoon($conditionsJson, $codEsc)
    {
        $currentDate = Carbon::today();
        $codPer = '2025-1';

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
                }
            }

            if ($allRulesMet) {
                return $condition['next_option_id'];
            }
        }

        return null;
    }

    public function getEvalForAmpliacionCreditos($conditionsJson, $ampCred, $ciclo)
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

                if ($field === 'amp_cred') {
                    if ($ampCred != $value) {
                        $allRulesMet = false;
                        break;
                    }
                }
                if ($field === 'ciclo') {
                    if (is_array($value)) {
                        if (!($ciclo >= (int) $value[0] && $ciclo <= (int) $value[1])) {
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
                if (!$ampCred) {
                    if ($ciclo === 10) {
                        return 93;
                    } else {
                        return 94;
                    }
                }

                return $condition['next_option_id'];
            }
        }

        return null;
    }






    public function getClienteTempMatricula($nroDoc)
    {
        return TempMatricula::where('dni', $nroDoc)->first();
    }


}
