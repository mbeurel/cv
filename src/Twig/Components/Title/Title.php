<?php
/*
 * This file is part of the App package.
 *
 * (c) Yipikai <support@yipikai.studio>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig\Components\Title;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent("Title", template: 'Twig/Components/Title/title.html.twig')]
final class Title
{
  public ?string $htmlTag = "h2";
  public ?string $theme = "";
  public ?string $value = "";
  public bool $underline = false;
  public bool $upper = false;
  public bool $color = false;


  /**
   * optionsResolver
   *
   * @param OptionsResolver $resolver
   * @return OptionsResolver
   */
  public static function optionsResolver(OptionsResolver $resolver): OptionsResolver
  {
    $resolver->setIgnoreUndefined(true);
    $resolver->setDefault('htmlTag', 'span')
      ->setAllowedValues('htmlTag', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span'])
      ->addAllowedTypes("htmlTag", array("string"));

    $resolver->setDefault('theme', 'default')
      ->setAllowedValues('theme', ["default", "title-1", "title-2", "title-3", "title-4", "title-5", "title-xl"])
      ->addAllowedTypes("theme", array("string"));

    $resolver->setDefault('value', '')
      ->addAllowedTypes("value", array("string"));

    $resolver->setDefault('underline', false)
      ->addAllowedTypes("underline", array("bool"));

    $resolver->setDefault('upper', false)
      ->addAllowedTypes("upper", array("bool"));

    $resolver->setDefault('color', false)
      ->addAllowedTypes("color", array("bool"));

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
