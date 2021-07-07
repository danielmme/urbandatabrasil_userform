<?php

namespace Drupal\urbandatabrasil_userform\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;

/**
 * Provides a 'authorName' migrate process plugin.
 *
 * @MigrateProcessPlugin(
 *  id = "author"
 * )
 */
class authorName extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {

    // Plugin logic goes here.
    $author = trim($value);
    $normalized = explode(" ", $author);
    $last = end($normalized) . ",";
    array_pop($normalized);
    array_unshift($normalized, $last);
    $name = implode(" ", $normalized);
    return $name;
  }

}
