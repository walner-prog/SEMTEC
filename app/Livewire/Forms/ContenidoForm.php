<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\DB;
use App\Models\Unidad;
use App\Models\Competencia;
use App\Models\Indicador;
use App\Models\Actividad;
use App\Models\Item;
use Illuminate\Validation\ValidationException;

class ContenidoForm
{

 

    public function guardar(array $form)
    {
        $this->validarFormulario($form);

        DB::beginTransaction();
        try {
            if (empty($form['unidad']['orden'])) {
                $ultimoOrden = Unidad::where('grado_id', $form['unidad']['grado_id'])->max('orden');
                $form['unidad']['orden'] = $ultimoOrden ? $ultimoOrden + 1 : 1;
            }
            
            $form['unidad']['docente_id'] = auth()->id();
            $unidad = Unidad::create($form['unidad']);

            foreach ($form['competencias'] as $compIndex => $comp) {
                $competencia = Competencia::create([
                    'unidad_id' => $unidad->id,
                    'titulo' => $comp['titulo'],
                    'descripcion' => $comp['descripcion'] ?? null,
                    'orden' => $comp['orden'] ?? ($compIndex + 1),
                ]);

                foreach ($form['indicadores'][$comp['temp_id']] ?? [] as $indIndex => $ind) {
                    $indicador = Indicador::create([
                        'competencia_id' => $competencia->id,
                        'titulo' => $ind['titulo'],
                        'descripcion' => $ind['descripcion'] ?? null,
                        'orden' => $ind['orden'] ?? ($indIndex + 1),
                    ]);

                    foreach ($form['actividades'][$ind['temp_id']] ?? [] as $actIndex => $act) {
                        $media = $act['media_json'] ?? [];
                        if (!is_array($media)) {
                            $media = [$media];
                        }

                        $actividad = Actividad::create([
                            'indicador_id' => $indicador->id,
                            'titulo' => $act['titulo'],
                            'objetivo' => $act['objetivo'],
                            'tipo' => $act['tipo'],
                            'accesibilidad_flags' => json_encode($act['accesibilidad_flags']),
                            'media_video' => $act['media_video'] ?? null,
                            'media_documento' => $act['media_documento'] ?? null,
                            'dificultad_min' => $act['dificultad_min'] ?? 1,
                            'dificultad_max' => $act['dificultad_max'] ?? 3,
                            'orden' => $act['orden'] ?? ($actIndex + 1),
                            'con_tiempo' => $act['con_tiempo'] ?? false,
                            'limite_tiempo' => $act['limite_tiempo'] ?? null,
                        ]);


                        foreach ($act['items'] ?? [] as $i => $item) {
                            Item::create([
                                'actividad_id' => $actividad->id,
                                'enunciado' => $item['enunciado'],
                                'respuesta' => $item['respuesta'] ?? null,
                                'datos' => $item['datos'] ?? null,
                                'retro' => $item['retro'] ?? null,
                                'orden' => $item['orden'] ?? ($i + 1),
                            ]);
                        }
                    }
                }
            }

            DB::commit();
            return $unidad;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // ---------------- Actualizar ----------------
    public function actualizar(Unidad $unidad, array $form)
    {
        $this->validarFormulario($form);

        if ($unidad->docente_id !== auth()->id()) {
            throw ValidationException::withMessages(['unidad' => 'No puedes editar unidades de otro docente.']);
        }

        DB::beginTransaction();
        try {
            $unidad->update($form['unidad']);

            $competenciasExistentes = $unidad->competencias()->pluck('id')->toArray();
            $competenciasForm = [];

            foreach ($form['competencias'] as $compIndex => $comp) {
                if (!empty($comp['id'])) {
                    $competencia = Competencia::find($comp['id']);
                    $competencia->update([
                        'titulo' => $comp['titulo'],
                        'descripcion' => $comp['descripcion'] ?? null,
                        'orden' => $comp['orden'] ?? ($compIndex + 1),
                    ]);
                } else {
                    $competencia = Competencia::create([
                        'unidad_id' => $unidad->id,
                        'titulo' => $comp['titulo'],
                        'descripcion' => $comp['descripcion'] ?? null,
                        'orden' => $comp['orden'] ?? ($compIndex + 1),
                    ]);
                }
                $competenciasForm[] = $competencia->id;

                $indicadoresExistentes = $competencia->indicadores()->pluck('id')->toArray();
                $indicadoresForm = [];

                foreach ($form['indicadores'][$comp['temp_id']] ?? [] as $indIndex => $ind) {
                    if (!empty($ind['id'])) {
                        $indicador = Indicador::find($ind['id']);
                        $indicador->update([
                            'titulo' => $ind['titulo'],
                            'descripcion' => $ind['descripcion'] ?? null,
                            'orden' => $ind['orden'] ?? ($indIndex + 1),
                        ]);
                    } else {
                        $indicador = Indicador::create([
                            'competencia_id' => $competencia->id,
                            'titulo' => $ind['titulo'],
                            'descripcion' => $ind['descripcion'] ?? null,
                            'orden' => $ind['orden'] ?? ($indIndex + 1),
                        ]);
                    }
                    $indicadoresForm[] = $indicador->id;

                    $actividadesExistentes = $indicador->actividades()->pluck('id')->toArray();
                    $actividadesForm = [];

                    foreach ($form['actividades'][$ind['temp_id']] ?? [] as $actIndex => $act) {
                        $media = $act['media_json'] ?? [];
                        if (!is_array($media)) {
                            $media = [$media];
                        }

                        $actividadData = [
                            'titulo' => $act['titulo'],
                            'objetivo' => $act['objetivo'],
                            'tipo' => $act['tipo'],
                            'accesibilidad_flags' => json_encode($act['accesibilidad_flags']),
                            'media_video' => $act['media_video'] ?? null,
                            'media_documento' => $act['media_documento'] ?? null,
                            'dificultad_min' => $act['dificultad_min'] ?? 1,
                            'dificultad_max' => $act['dificultad_max'] ?? 3,
                            'orden' => $act['orden'] ?? ($actIndex + 1),
                            'con_tiempo' => $act['con_tiempo'] ?? false,
                            'limite_tiempo' => $act['limite_tiempo'] ?? null,
                        ];


                        if (!empty($act['id'])) {
                            $actividad = Actividad::find($act['id']);
                            $actividad->update($actividadData);
                        } else {
                            $actividad = Actividad::create(array_merge(['indicador_id' => $indicador->id], $actividadData));
                        }
                        $actividadesForm[] = $actividad->id;

                        $itemsExistentes = $actividad->items()->pluck('id')->toArray();
                        $itemsForm = [];

                        foreach ($act['items'] ?? [] as $i => $item) {
                            if (!empty($item['id'])) {
                                $itm = Item::find($item['id']);
                                $itm->update([
                                    'enunciado' => $item['enunciado'],
                                    'respuesta' => $item['respuesta'] ?? null,
                                    'datos' => $item['datos'] ?? null,
                                    'retro' => $item['retro'] ?? null,
                                    'orden' => $item['orden'] ?? ($i + 1),
                                ]);
                            } else {
                                $itm = Item::create([
                                    'actividad_id' => $actividad->id,
                                    'enunciado' => $item['enunciado'],
                                    'respuesta' => $item['respuesta'] ?? null,
                                    'datos' => $item['datos'] ?? null,
                                    'retro' => $item['retro'] ?? null,
                                    'orden' => $item['orden'] ?? ($i + 1),
                                ]);
                            }
                            $itemsForm[] = $itm->id;
                        }

                        $itemsEliminar = array_diff($itemsExistentes, $itemsForm);
                        if ($itemsEliminar) Item::whereIn('id', $itemsEliminar)->delete();
                    }

                    $actividadesEliminar = array_diff($actividadesExistentes, $actividadesForm);
                    if ($actividadesEliminar) Actividad::whereIn('id', $actividadesEliminar)->delete();
                }

                $indicadoresEliminar = array_diff($indicadoresExistentes, $indicadoresForm);
                if ($indicadoresEliminar) Indicador::whereIn('id', $indicadoresEliminar)->delete();
            }

            $competenciasEliminar = array_diff($competenciasExistentes, $competenciasForm);
            if ($competenciasEliminar) Competencia::whereIn('id', $competenciasEliminar)->delete();

            DB::commit();
            return $unidad;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // ---------------- Cargar para editar ----------------
    public function cargarParaEditar(Unidad $unidad)
    {
        $form = [
            'unidad' => [
                'id' => $unidad->id,
                'titulo' => $unidad->titulo,
                'descripcion' => $unidad->descripcion,
                'grado_id' => $unidad->grado_id,
                'orden' => $unidad->orden,
            ],
            'competencias' => [],
            'indicadores' => [],
            'actividades' => [],
        ];

        foreach ($unidad->competencias()->orderBy('orden')->get() as $comp) {
            $tempCompId = uniqid();
            $form['competencias'][] = [
                'id' => $comp->id,
                'temp_id' => $tempCompId,
                'titulo' => $comp->titulo,
                'descripcion' => $comp->descripcion,
                'orden' => $comp->orden,
            ];

            $form['indicadores'][$tempCompId] = [];
            foreach ($comp->indicadores()->orderBy('orden')->get() as $ind) {
                $tempIndId = uniqid();
                $form['indicadores'][$tempCompId][] = [
                    'id' => $ind->id,
                    'temp_id' => $tempIndId,
                    'titulo' => $ind->titulo,
                    'descripcion' => $ind->descripcion,
                    'orden' => $ind->orden,
                ];

                $form['actividades'][$tempIndId] = [];
                foreach ($ind->actividades()->orderBy('orden')->get() as $act) {
                    $media = json_decode($act->media_json, true) ?? [];
                    if (!is_array($media)) $media = [$media];

                    $form['actividades'][$tempIndId][] = [
                        'id' => $act->id,
                        'titulo' => $act->titulo,
                        'objetivo' => $act->objetivo,
                        'tipo' => $act->tipo,
                        'accesibilidad_flags' => json_decode($act->accesibilidad_flags, true) ?? ['tts' => false, 'isn' => false],
                        'media_video' => $act->media_video,
                        'media_documento' => $act->media_documento,
                        'dificultad_min' => $act->dificultad_min,
                        'dificultad_max' => $act->dificultad_max,
                        'orden' => $act->orden,
                        'con_tiempo' => $act->con_tiempo,
                        'limite_tiempo' => $act->limite_tiempo,
                        'items' => $act->items()->orderBy('orden')->get()->map(fn($item) => [
                            'id' => $item->id,
                            'enunciado' => $item->enunciado,
                            'respuesta' => $item->respuesta,
                            'datos' => $item->datos,
                            'retro' => $item->retro,
                            'orden' => $item->orden,
                        ])->toArray(),
                    ];
                }
            }
        }

        return $form;
    }

    // ---------------- Validaciones internas ----------------
    protected function validarFormulario(array $form)
    {
        if (empty($form['unidad']['titulo'])) {
            throw ValidationException::withMessages(['unidad.titulo' => 'El título de la unidad es obligatorio.']);
        }

        if (empty($form['unidad']['grado_id'])) {
            throw ValidationException::withMessages(['unidad.grado_id' => 'Debes seleccionar un grado.']);
        }

        if (empty($form['competencias'])) {
            throw ValidationException::withMessages(['competencias' => 'Debes agregar al menos una competencia.']);
        }

        foreach ($form['competencias'] as $comp) {
            $inds = $form['indicadores'][$comp['temp_id']] ?? [];
            if (empty($inds)) {
                throw ValidationException::withMessages(["indicadores" => "La competencia '{$comp['titulo']}' debe tener al menos un indicador."]);
            }

            foreach ($inds as $ind) {
                $acts = $form['actividades'][$ind['temp_id']] ?? [];
                if (empty($acts)) {
                    throw ValidationException::withMessages(["actividades" => "El indicador '{$ind['titulo']}' debe tener al menos una actividad."]);
                }

                foreach ($acts as $act) {
                    if (empty($act['items'])) {
                        throw ValidationException::withMessages(["items" => "La actividad '{$act['titulo']}' debe tener al menos un ítem."]);
                    }
                }
            }
        }
    }

    // ---------------- Métodos remove dinámicos ----------------
    public function removeCompetencia(array &$form, $index)
    {
        $comp = $form['competencias'][$index];
        $tempId = $comp['temp_id'] ?? null;

        if ($tempId) {
            unset($form['indicadores'][$tempId]);
            foreach ($form['actividades'] as $indId => $acts) {
                if ($indId === $tempId) unset($form['actividades'][$indId]);
            }
        }

        unset($form['competencias'][$index]);
        $form['competencias'] = array_values($form['competencias']);
    }

    public function removeIndicador(array &$form, $compTempId, $indIndex)
    {
        $indTempId = $form['indicadores'][$compTempId][$indIndex]['temp_id'] ?? null;
        if ($indTempId) unset($form['actividades'][$indTempId]);

        unset($form['indicadores'][$compTempId][$indIndex]);
        $form['indicadores'][$compTempId] = array_values($form['indicadores'][$compTempId]);
    }

    public function removeActividad(array &$form, $indTempId, $actIndex)
    {
        unset($form['actividades'][$indTempId][$actIndex]);
        $form['actividades'][$indTempId] = array_values($form['actividades'][$indTempId]);
    }

    public function removeItem(array &$form, $indTempId, $actIndex, $itemIndex)
    {
        unset($form['actividades'][$indTempId][$actIndex]['items'][$itemIndex]);
        $form['actividades'][$indTempId][$actIndex]['items'] = array_values($form['actividades'][$indTempId][$actIndex]['items']);
    }
}
