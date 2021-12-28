<?php

/**
 * @OA\Get(
 *     path="/v1/users",
 *     summary="Carrega uma lista de usuários",
 *     description="Carrega lista de usuários disponíveis",
 *     tags={"Users"},
 *
 *     @OA\Response(
 *       response="200",
 *       description="Lista de usuários encontrada",
 *       @OA\JsonContent(ref="#/components/schemas/Error")
 *     ),
 *
 *     @OA\Response(
 *       response="400",
 *       description="Erro de uma ação disparada pelo consumidor",
 *       @OA\JsonContent(ref="#/components/schemas/Error")
 *     )
 * )
 */
