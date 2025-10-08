<?php
/*
 * This file is part of the App package.
 *
 * (c) Yipikai <support@yipikai.studio>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig\Components\Picto;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent("Picto", template: 'Twig/Components/Picto/picto.html.twig')]
final class Picto
{

  public ?string $name = null;
  public string $format = 'svg';
  public ?string $value = null;
  public ?string $size = "middle";

  protected array $componentPictoParameters;


  public function __construct(
    #[Autowire('%component_picto%')] array $componentPictoParameters
  )
  {
    $this->componentPictoParameters = $componentPictoParameters;
  }

  #[PreMount]
  public function preMount(array $data): array
  {
    $resolver = new OptionsResolver();
    $resolver->setIgnoreUndefined(true);

    $resolver->setDefault('name', null)
      ->addAllowedTypes("name", array("null", "string"));

    $resolver->setDefault('format', "svg")
      ->setAllowedValues('format', $this->componentPictoParameters["formats"])
      ->addAllowedTypes("format", array("string"));

    $resolver->setDefault('size', "medium")
      ->setAllowedValues('size', array("small", "medium", "large"))
      ->addAllowedTypes("size", array("string"));

    return $resolver->resolve($data) + $data;
  }

  #[PostMount]
  public function postMount(array $data): array
  {
    foreach($this->componentPictoParameters["path"] as $path)
    {
      if(!$this->name)
      {
        $this->name = $this->componentPictoParameters["default"];
      }

      $filepath = $path."/".$this->name.".".$this->format;
      if(file_exists($filepath) && !$this->value) {
        $this->value = file_get_contents($filepath);
      }
    }
    return $data;
  }

}
