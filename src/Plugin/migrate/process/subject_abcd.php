<?php

namespace Drupal\urbandatabrasil_userform\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;
use Drupal\taxonomy\Entity\Term;

/**
 * Provides a 'subject' migrate process plugin.
 *
 * @MigrateProcessPlugin(
 *  id = "subject_abcd"
 * )
 */
class subject_abcd extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {

    $vocabulary = $this->configuration['vocabulary'];
    $term_name = null;
    $tid = null;
    $result = [];

    // $pattern = '/\^a /';
    // $replacement = '';

    $disciplina = [
      '^a Planejamento Urbano'=>'Planejamento Urbano',
      '^a Antropologia Urbana'=>'Antropologia',
      '^a Economia Urbana'=>'Economia',
      '^a Sociologia Urbana'=>'Sociologia',
      '^a Geografia Urbana'=>'Geografia',
      '^a Direito Urbano'=>'Direito',
      '^a Demografia'=>'Demografia',
      '^a História Urbana^a Geografia Urbana'=>'História',
      '^a História Urbana'=>'História',
      '^a Medicina Social/Saúde Pública'=>'Medicina Social / Saúde Pública',
      '^a História Urbana^a Sociologia Urbana'=>'História',
      '^a Ciência Política'=>'Ciência Política',
      '^a Arquitetura'=>'Arquitetura e Urbanismo',
      '^a História Urbana^a Planejamento Urbano'=>'História',
      '^a Produção Institucional'=>'Definir',
      '^a Comunicação'=>'Comunicação',
      '^a Jornalismo'=>'Comunicação',
      '^a Administração Pública'=>'Economia',
      '^a Engenharia'=>'Engenharia',
      '^a História Urbana^a Antropologia Urbana'=>'História',
      '^a História Urbana^a Medicina Social/Saúde Pública'=>'História',
      '^a Depoimento Pessoal'=>'Definir',
      '^a Serviço Social'=>'Serviço Social',
      '^a Educação'=>'Educação',
      '^a Arquitetura e Urbanismo'=>'Arquitetura e Urbanismo',
      '^a Filosofia'=>'Interdisciplinar',
      '^a Engenharia de Produção'=>'Engenharia',
      '^a Psiquiatria'=>'Psicologia',
      '^a História Urbana^a Demografia'=>'História',
      '^a História Urbana^a Ciência Política'=>'História',
      '^a Administração Municipal'=>'Economia',
      '^a Administração'=>'Economia',
      '^a História Urbana^a Economia Urbana'=>'História',
      '^a Estatística'=>'Demografia',
      '^a Teologia'=>'Interdisciplinar',
      '^a Urbanismo'=>'Arquitetura e Urbanismo',
      '^a História Urbana^a Direito Urbano'=>'História',
      '^a Psicologia'=>'Psicologia',
      '^a Sociologia'=>'Sociologia',
      '^a Antropologia'=>'Antropologia',
      '^a Estruturas Ambientais Urbanas'=>'Ciência Ambiental',
      '^a Desenvolvimento Urbano'=>'Planejamento Urbano',
      '^a Direito'=>'Direito',
      '^a Letras'=>'Letras',
      '^a Engenharia Industrial'=>'Engenharia',
      '^a Comunicação Social'=>'Comunicação',
      '^a Trabalho e Sindicalismo'=>'Economia',
      '^a Segurança Pública'=>'Direito',
      '^a Psicossociologia'=>'Psicologia',
      '^a Administração pública'=>'Economia',
      '^a Políticas Públicas'=>'Ciência Política',
      '^a Ciências Sociais Aplicadas à Educação'=>'Interdisciplinar',
      '^a Engenharia Sanitária'=>'Engenharia',
      '^a Engenharia Civil'=>'Engenharia',
      '^a Ciência da Informação'=>'Interdisciplinar',
      '^a Medicina'=>'Medicina Social / Saúde Pública',
      '^a Desenvolvimento Social'=>'Economia',
      '^a Enfermagem'=>'Medicina Social / Saúde Pública',
      '^a Literatura'=>'Letras',
      '^a Desenvolvimento Urbano e Regional'=>'Economia',
      '^a Psicologia Social'=>'Psicologia',
      '^a Desenvolvimento, Agricultura e Sociedade'=>'Ciência Ambiental',
      '^a Ciências da Religião'=>'Interdisciplinar',
      '^a Engenharia de Transportes'=>'Engenharia',
      '^a História da Arte'=>'História',
      '^a Psicologia Clínica'=>'Psicologia',
      '^a Desenvolvimento Sustentável'=>'Ciência Ambiental',
      '^a Política de Desenvolvimento Regional'=>'Economia',
      '^a Pediatria'=>'Medicina Social / Saúde Pública',
      '^a Tecnologia da Arquitetura'=>'Arquitetura e Urbanismo',
      '^a Administração de Empresas'=>'Economia',
      '^a Biologia'=>'Ciência Ambiental',
      '^a Planejamento Energético'=>'Engenharia',
      '^a Meio Ambiente e Desenvolvimento'=>'Ciência Ambiental',
      '^a Romance'=>'Letras',
      '^a Depoimento pessoal'=>'Definir',
      '^a Medicina Social / Saúde Pública'=>'Medicina Social / Saúde Pública',
      '^a Desenvolvimento e Meio Ambiente'=>'Ciência Ambiental',
      '^a Desenvolvimento Regional'=>'Economia',
      '^a Meio Ambiente'=>'Ciência Ambiental',
      '^a Planejamento do Desenvolvimento'=>'Planejamento Urbano',
      '^a Geologia'=>'Geografia',
      '^a Direito Administrativo'=>'Direito',
      '^a Educação Artística'=>'Educação',
      '^a Ciência do Ambiente e Sustentabilidade na Amazônia'=>'Ciência Ambiental',
      '^a História'=>'História',
      '^a Artes'=>'Artes',
      '^a Lingüística'=>'Letras',
      '^a Saneamento, Meio Ambiente e Recursos Hídricos'=>'Ciência Ambiental',
      '^a Arte e Arquelogia'=>'Artes',
      '^a Programa Visual'=>'Comunicação',
      '^a Geoquímica Ambiental'=>'Ciência Ambiental',
      '^a Administração Rural e Comunicação Rural'=>'Economia',
      '^a Ciência Ambiental'=>'Ciência Ambiental',
      '^a Gestão e Política Ambiental'=>'Ciência Ambiental',
      '^a Arqueologia'=>'História',
      '^a Psicologia de Comunidades e Ecologia Social'=>'Psicologia',
      '^a Direito das Organizações'=>'Direito',
      '^a Educação Ambiental'=>'Educação',
      '^a serviço social'=>'Serviço Social',
      '^a Engenharia Urbana'=>'Engenharia',
      '^a Ecologia e recursos naturais'=>'Ciência Ambiental',
      '^a Arquitetura e urbanismo'=>'Arquitetura e Urbanismo',
      '^a Nutrição'=>'Medicina Social / Saúde Pública',
      '^a arquitetura e urbanismo'=>'Arquitetura e Urbanismo',
      '^a arquitetura e Urbanismo'=>'Arquitetura e Urbanismo',
      '^a educação'=>'Educação',
      '^a psicologia social'=>'Psicologia',
      '^a Comunicação social'=>'Comunicação',
      '^a Sociologia urbana'=>'Sociologia',
      '^a Turismo'=>'Turismo',
      '^a Estudos de Literatura'=>'Letras',
      '^a Geografia'=>'Geografia',
      '^a Criminologia'=>'Direito',
      '^a Geografia Política'=>'Geografia',
      '^a Geografia Cultural'=>'Geografia',
      '^a Direito urbano'=>'Direito',
      '^a História Econômica'=>'História',
      '^a História Comparada'=>'História',
      '^a Etnografia'=>'Interdisciplinar',
      '^a Planejamento urbano'=>'Planejamento Urbano',
      '^a Ciências Sociais'=>'Interdisciplinar',
      '^a Desenvolvimento urbano e regional'=>'Economia',
      '^a Antropologia urbana'=>'Antropologia',
      '^a Sociologia do trabalho'=>'Sociologia',
      '^a Saúde Pública'=>'Medicina Social / Saúde Pública',
      '^a Sociologia econômica'=>'Sociologia',
      '^a Sociologia do cinema'=>'Sociologia',
      '^a Antropologia da música'=>'Antropologia',      
    ];

    // $term_name = preg_replace($pattern, $replacement, $value);

    foreach($disciplina as $aux => $element) {
      if ($value == $aux) {
        $term_name = $element;
      }
    }
   
    if($term_name) {
      if (!$this->getTidByName($term_name, $vocabulary)) {
        $term = Term::create([
          'name' => $term_name, 
          'vid'  => $vocabulary,
        ])->save();
      }
      $tid =  $this->getTidByName($term_name, $vocabulary);
      $result = ['target_id' => $tid];
    }
      return $result;
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
