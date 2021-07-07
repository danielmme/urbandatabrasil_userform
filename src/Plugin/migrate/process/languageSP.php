<?php

namespace Drupal\urbandatabrasil_userform\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;

/**
 * Provides a 'LanguagePlugin' migrate process plugin.
 *
 * @MigrateProcessPlugin(
 *  id = "languageSP"
 * )
 */
class languageSP extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {

    $array = [
      "portugues" => "Português",
      "espanhol" => "Espanhol",
      "frances" => "Francês",
      "ingles" => "Inglês",
      "italiano" => "Italiano",
      "alemao" => "Alemão",
      "outros" => "Outro",
    ];
    // Plugin logic goes here.
    return array_search($value,$array);
  }

}
