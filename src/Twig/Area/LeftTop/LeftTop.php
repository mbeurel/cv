<?php
/*
 * This file is part of the App package.
 *
 * (c) Yipikai <support@yipikai.studio>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig\Area\LeftTop;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent("LeftTop", template: 'Twig/Area/left-top.html.twig')]
final class LeftTop
{
  public string $name = "";
  public string $baseline = "";
  public string $picture = "";


  /**
   * optionsResolver
   *
   * @param OptionsResolver $resolver
   * @return OptionsResolver
   */
  public static function optionsResolver(OptionsResolver $resolver): OptionsResolver
  {
    $resolver->setIgnoreUndefined(true);
    $resolver->setDefault('name', "")
      ->setAllowedTypes("name", array("null", "string"));

    $resolver->setDefault('baseline', "")
      ->setAllowedTypes("baseline", array("string"));

    $resolver->setDefault('picture', "")
      ->setAllowedTypes("picture", array("string"));
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
