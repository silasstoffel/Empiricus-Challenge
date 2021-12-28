<?php

/**
 * @OA\Delete (
 *     path="/v1/users/{id}",
 *     summary="Deleta um usuário",
 *     description="Deleta um usuário",
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
 *       response="204",
 *       description="Usuário deletado com sucesso.",
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
