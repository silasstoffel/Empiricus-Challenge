<?php

/**
 * @OA\Put(
 *     path="/v1/users/{id}",
 *     summary="Atualiza um usuário",
 *     description="Atualiza um usuário",
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
 *     @OA\RequestBody(
 *         description="Atributos para atualização do usuário",
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UserPayload")
 *     ),
 *
 *     @OA\Response(
 *       response="204",
 *       description="Usuário atualizado com sucesso.",
 *     ),
 *
 *     @OA\Response(
 *       response="400",
 *       description="Erro de uma ação disparada pelo consumidor.",
 *       @OA\JsonContent(ref="#/components/schemas/Error")
 *     ),
 *
 *     @OA\Response(
 *       response="422",
 *       description="Validação de uma ação disparada pelo consumidor",
 *       @OA\JsonContent(ref="#/components/schemas/Error")
 *     )
 * )
 */
