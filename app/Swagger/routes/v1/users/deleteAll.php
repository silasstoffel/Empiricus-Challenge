<?php

/**
 * @OA\Delete (
 *     path="/v1/users",
 *     summary="Deleta todos usuários",
 *     description="Deleta todos usuários",
 *     tags={"Users"},
 *
 *     @OA\RequestBody(
 *         description="Corpo para deletar todos usuarios",
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UserDeleteAllPayload")
 *     ),
*
 *     @OA\Response(
 *       response="204",
 *       description="Usuários deletados com sucesso.",
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
