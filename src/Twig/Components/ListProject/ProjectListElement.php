<?php
/*
 * This file is part of the App package.
 *
 * (c) Yipikai <support@yipikai.studio>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig\Components\ListProject;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent("ProjectListElement", template: 'Twig/Components/ProjetList/list-project-element.html.twig')]
final class ProjectListElement
{

  public string $htmlTag = "li";
  public string $entitled = "";
  public string $subTitle = "";
  public string $description = "";
  public string $class = "";
  public ?string $url = null;
  public array $technos = array();

  /**
   * optionsResolver
   *
   * @param OptionsResolver $resolver
   * @return OptionsResolver
   */
  public static function optionsResolver(OptionsResolver $resolver): OptionsResolver
  {
    $resolver->setIgnoreUndefined(true);
    $resolver->setDefault('htmlTag', 'li')
      ->setAllowedTypes("htmlTag", array("string"))
      ->setAllowedValues("htmlTag", array("div", "li"));

    $resolver->setDefault('entitled', '')
      ->setAllowedTypes("entitled", array("string"));

    $resolver->setDefault('subTitle', '')
      ->setAllowedTypes("subTitle", array("string"));

    $resolver->setDefault('description', '')
      ->setAllowedTypes("description", array("string"));

    $resolver->setDefault('class', '')
      ->setAllowedTypes("class", array("string"));

    $resolver->setDefault('url', null)
      ->setAllowedTypes("url", array("null", "string"));

    $resolver->setDefault('technos', array())
      ->setAllowedTypes("technos", array("array"));
    return $resolver;
  }

  #[PreMount]
  public function preMount(array $data): array
  {
    $resolver = new OptionsResolver();
    $resolver = self::optionsResolver($resolver);
    return $resolver->resolve($data) + $data;
  }

  #[PostMount]
  public function postMount(array $data): array
  {
    return $data;
  }

}
