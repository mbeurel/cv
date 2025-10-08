<?php
/*
 * This file is part of the App package.
 *
 * (c) Yipikai <support@yipikai.studio>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig\Components\ListWithPicto;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent("ListWithPictoElement", template: 'Twig/Components/ListWithPicto/list-with-picto-element.html.twig')]
final class ListWithPictoElement
{

  public string $htmlTag = "li";
  public string $entitled = "";
  public string $picto = "";
  public string $class = "";
  public ?string $url = null;

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

    $resolver->setDefault('picto', '')
      ->setAllowedTypes("picto", array("string"));

    $resolver->setDefault('class', '')
      ->setAllowedTypes("class", array("string"));

    $resolver->setDefault('url', null)
      ->setAllowedTypes("url", array("null", "string"));
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
