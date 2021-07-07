<?php

namespace Drupal\urbandatabrasil_userform\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;
use Drupal\taxonomy\Entity\Term;

/**
 * Provides a 'thematicArea' migrate process plugin.
 *
 * @MigrateProcessPlugin(
 *  id = "area_tematica"
 * )
 */
class thematicAreaSP extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {

    $vocabulary = $this->configuration['vocabulary'];
    $term_name = null;
    $tid = null;
    $results = [];

    $map_area_tematica = [
      'Administração e finanças públicas'=>1,
      'Arte e estética'=>2,
      'Construção civil'=>3,
      'Espaço urbano'=> 4,
      'Estrutura social'=>5,
      'Estrutura econômica e mercado de trabalho'=>6,
      'Estrutura regional e metropolitana'=>7,
      'Evolução urbana'=>8,
      'Fluxos populacionais e migrações'=>9,
      'Gênero e sexualidade'=>10,
      'Habitação'=>11,
      'Ideologia e política'=>12,
      'Infância e juventude'=>13,
      'Infraestrutura urbana, serviços urbanos e equipamentos coletivos'=>14,
      'Meio ambiente e qualidade de vida'=>15,
      'Memória, preservação e patrimônio'=>16,
      'Mídia e comunicação'=>17,
      'Mobilidade urbana'=>18,
      'Modo de vida, imaginário social e cotidiano'=>19,
      'Movimentos sociais'=>20,
      'Novas tecnologias e meio urbano'=>21,
      'Ongs e Terceiro Setor'=>22,
      'Planejamento urbano'=>23,
      'Pobreza e desigualdade'=>24,
      'Poder local e gestão urbana'=>25,
      'Políticas públicas'=>26,
      'Processos de urbanização'=>27,
      'Relações étnico-raciais'=>28,
      'Religiões, rituais e comemorações'=>29,
      'Serviços, espaços e práticas de lazer'=>30,
      'Serviços, espaços e padrões de consumo'=>31,
      'Setor informal/Informalidade'=>32,
      'Solo urbano'=>33,
      'Turismo e cultura de viagem'=>34,
      'Violência'=>35,
    ];
    foreach($value as $num) {
      foreach($map_area_tematica as $aux => $element) {
        if ($num == $element) {
          $term_name = $aux;
          if($term_name) {
            if (!$this->getTidByName($term_name, $vocabulary)) {
              $term = Term::create([
                'name' => $term_name, 
                'vid'  => $vocabulary,
              ])->save();
            }
            $tid =  $this->getTidByName($term_name, $vocabulary);
            $results[] = ['target_id' => $tid];
          }
        }
      }
    }
    print_r($results);
    return $results;
  }

  /**
   * Load term by name.
   */
  protected function getTidByName($name = NULL, $vocabulary = NULL) {
    $tid = null;
    $properties = [];
    if (!empty($name) && !empty($vocabulary)) {
      $properties['name'] = $name;
      $properties['vid'] = $vocabulary;
      $terms = \Drupal::entityManager()->getStorage('taxonomy_term')->loadByProperties($properties);
      $term = reset($terms);
      $tid = is_object($term) ? $term->id() : null;
    }
    return $tid;
  }

}
