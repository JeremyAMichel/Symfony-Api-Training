<?php

declare(strict_types=1);

namespace App\Controller;

use App\CashMachine\CashMachineRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CashMachineController extends AbstractController
{
    #[Route('/api/{currency}/change/{amount}', name: 'app_api')]
    public function api(string $currency, float $amount, CashMachineRegistry $registry): Response
    {

        $jsonContent = [];

        try {
            $registry->get(strtoupper($currency));
        } catch (\Exception $e) {
            throw new NotFoundHttpException("Not Registered, you are trying to use a currency that is 
            not registered", $e, 404);
        }

        $cashMachine = $registry->get(strtoupper($currency));

        try {
            foreach ($cashMachine->change($amount)->content() as $c) {
                array_push($jsonContent, [$c->amount(), $c->quantity()]);
            }
        } catch (\Exception $e) {
            throw new BadRequestHttpException("Cannot Change, invalid change due", $e, 400);
        }

        $symbol = $cashMachine->currency()->symbol();

        return $this->json([
            "currency" => $symbol,
            "envelope" => $jsonContent,
        ]);
    }
}
