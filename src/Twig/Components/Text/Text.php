<?php
/*
 * This file is part of the App package.
 *
 * (c) Yipikai <support@yipikai.studio>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig\Components\Text;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent("Text", template: 'Twig/Components/Text/text.html.twig')]
final class Text
{
  public bool $wysiwyg = false;
  public bool $isHeadline = false;
  public ?string $value = null;
  public ?string $theme = "md";


  /**
   * optionsResolver
   *
   * @param OptionsResolver $resolver
   * @return OptionsResolver
   */
  public static function optionsResolver(OptionsResolver $resolver): OptionsResolver
  {
    $resolver->setIgnoreUndefined(true);
    $resolver->setDefault('wysiwyg', false)
      ->addAllowedTypes("wysiwyg", array("bool"));

    $resolver->setDefault('isHeadline', false)
      ->addAllowedTypes("isHeadline", array("bool"));

    $resolver->setDefault('value', '')
      ->addAllowedTypes("value", array("null", "string"));

    $resolver->setDefault('theme', "md")
      ->setAllowedValues('theme', [null, "lg", "md", 'sm'])
      ->addAllowedTypes("theme", array("null", "string"));

    return $resolver;
  }

  #[PreMount]
  public function preMount(array $data): array
  {
    $resolver =  new OptionsResolver();
    $resolver = self::optionsResolver($resolver);
    return $resolver->resolve($data) + $data;
  }

  #[PostMount]
  public function postMount(array $data): array
  {
    if($this->value != strip_tags($this->value)) {
      $this->wysiwyg = true;
    }
    return $data;
  }

}
