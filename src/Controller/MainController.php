<?php
/*
 * This file is part of the App package.
 *
 * (c) Yipikai <support@yipikai.studio>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Controller;

use App\Template\TemplateParameters;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{

  protected TemplateParameters $templateParameters;

  public function __construct()
  {
    $this->templateParameters = new TemplateParameters();
  }

  #[Route('/')]
  public function index(): Response
  {
    $this->templateParameters->addParameters("page", array(
      "keyname" =>  "index",
      "meta"    =>  array(
        "title"       => "Matthieu Beurel - CV",
        "description" => "Matthieu Beurel - CV"
      )
    ));
    return $this->render('Pages/index.html.twig', $this->templateParameters->getParameters());
  }
}
