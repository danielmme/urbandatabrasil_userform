<?php

namespace Drupal\urbandatabrasil_userform\Plugin\migrate\process;

use Drupal\migrate\Row;
use Drupal\Core\Database\Database;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;

/**
 * Provides a 'refEspacialSP' migrate process plugin.
 *
 * @MigrateProcessPlugin(
 *  id = "prepare_multiple_paragraphs"
 * )
 */
class refEspacialSP extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {

    $connection = Database::getConnection('default', 'default');
    $paragraphs = [];
    $query = $connection->select('migrate_map_urbandata_paragraphs_sp', 'yt');
    $query->join('paragraph__field_id_ref', 'ref', 'ref.entity_id = yt.destid1 AND ref.revision_id = yt.destid2');
    $results = $query->fields('yt', ['destid1', 'destid2'])
      ->condition('ref.field_id_ref_value', $value, '=')
      ->execute()
      ->fetchAll();

    if (!empty($results)) {
      foreach ($results as $result) {
        $paragraphs[] = [
          'target_id' => $result->destid1,
          'target_revision_id' => $result->destid2,
        ];
      }
    }
    return $paragraphs;
  }

}
