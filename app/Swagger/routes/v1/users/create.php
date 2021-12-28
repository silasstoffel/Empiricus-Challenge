<?php

/**
 * @OA\Post(
 *     path="/v1/users",
 *     summary="Criar usuário",
 *     description="Cadastra um usuário",
 *     tags={"Users"},
 *
 *     @OA\RequestBody(
 *         description="Cadastra um usuario",
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UserPayload")
 *     ),
 *
 *     @OA\Response(
 *       response="201",
 *       description="Cadastro efetivado com sucesso.",
 *       @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *
 *     @OA\Response(
 *       response="400",
 *       description="Erro de uma ação disparada pelo consumidor",
 *       @OA\JsonContent(ref="#/components/schemas/Error")
 *     ),
 *
 *     @OA\Response(
 *       response="422",
 *       description="Validação de uma ação disparada pelo consumidor",
 *       @OA\JsonContent(ref="#/components/schemas/Error")
 *     ),
 * )
 */
