<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AIImageToProductGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\AIImageToProductGui\Business\AIImageToProductGuiFacadeInterface getFacade()
 * @method \Pyz\Zed\AIImageToProductGui\Communication\AIImageToProductGuiCommunicationFactory getFactory()
 * @method \Pyz\Zed\AIImageToProductGui\Persistence\AIImageToProductGuiQueryContainer getQueryContainer()
 */
class IndexController extends AbstractController
{
 /**
  * @return array
  */
    public function indexAction(Request $request): array
    {
        $form = $this
        ->getFactory()
        ->createAiProductForm()
        ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $skuPreffix =$form
            $fileUrl = $form->get('image')->getData();
            $imgTextClient = $this->getFactory()->getImageToTextClient();
            dd($imgTextClient->getNameDescriptionByUrl($fileUrl));
        }

        return $this->viewResponse([
            'form' => $form->createView(),
        ]);
    }
}
