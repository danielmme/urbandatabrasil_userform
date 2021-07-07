<?php

namespace Drupal\urbandatabrasil_userform\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;

/**
 * Provides a 'LanguagePlugin' migrate process plugin.
 *
 * @MigrateProcessPlugin(
 *  id = "materialTypeSP"
 * )
 */
class materialTypeSP extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {

    $array = [
      "artigo_periodico" => "Artigo" ,
      "outros" => "Paper",
      "trabalho_eventos" =>  "Anais",
      "livro_coletanea" => "Livro",
      "relatorio_tecnico" => "Relatório",
      "iniciacao_cientifica" => "Trabalho de Iniciação Científica",
      "conclusao_curso" => "Trabalho de Conclusão de Curso",
      "trabalho_especializacao" => "Trabalho de Especialização",
      "dissertacao_mestrado" => "Dissertação Mestrado",
      "tese_titularidade" => "Tese Titularidade",
      "tese_doutorado" => "Tese Doutorado",
      "livre_docencia" => "Livre Docência",
    ];
    // Plugin logic goes here.
    return array_search($value,$array);
  }

}
