<?php

/**
 * @OA\Get(
 *     path="/v1/users/{id}",
 *     summary="Carrega um usuário",
 *     description="Carrega dados de um usuário pelo ID",
 *     tags={"Users"},
 *
 *     @OA\Parameter(
 *         description="ID",
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(
 *           type="string"
 *         )
 *     ),
 *
 *     @OA\Response(
 *       response="200",
 *       description="Cadastro encontrado sucesso",
 *       @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *
 *     @OA\Response(
 *       response="400",
 *       description="Erro de uma ação disparada pelo consumidor",
 *       @OA\JsonContent(ref="#/components/schemas/Error")
 *     ),
 *
 * )
 */
