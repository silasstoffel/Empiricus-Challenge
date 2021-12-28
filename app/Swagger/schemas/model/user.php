<?php

/**
 * @OA\Schema(
 *   schema="UserPayload",
 *   title="UserPayload",
 *   required={"name", "email", "role", "city"},
 *
 *   @OA\Property(
 *     property="id",
 *     type="string",
 *     description="Identificação do usuário"
 *   ),
 *
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     description="Nome"
 *   ),
 *
 *   @OA\Property(
 *     property="email",
 *     type="string",
 *     description="E-mail"
 *   ),
 *
 *  @OA\Property(
 *     property="role",
 *     type="string",
 *     description="Papel do usuario no sistema. Valores aceitos: admin, customer, analist e crm"
 *   ),
 *
 *  @OA\Property(
 *     property="city",
 *     type="string",
 *     description="Cidade"
 *   ),
 *
 *  @OA\Property(
 *     property="password",
 *     type="string",
 *     description="Senha. Somente é obrigatório no cadastro"
 *   ),
 *
 *  @OA\Property(
 *     property="avatarUrl",
 *     type="string",
 *     description="URL do foto ou avatar do usuário"
 *   ),
 *
 *  @OA\Property(
 *     property="userIdAction",
 *     type="string",
 *     description="ID do usuario que está executando uma ação. Com esse parametro, será validado às permissões."
 *   )
 * )
 */

/**
 * @OA\Schema(
 *   schema="User",
 *   title="User",
 *   required={"name", "email", "role", "city"},
 *
 *   @OA\Property(
 *     property="id",
 *     type="string",
 *     description="Identificação do usuário"
 *   ),
 *
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     description="Nome"
 *   ),
 *
 *   @OA\Property(
 *     property="email",
 *     type="string",
 *     description="E-mail"
 *   ),
 *
 *  @OA\Property(
 *     property="role",
 *     type="string",
 *     description="Papel do usuario no sistema. Valores aceitos: admin, customer, analist e crm"
 *   ),
 *
 *  @OA\Property(
 *     property="city",
 *     type="string",
 *     description="Cidade"
 *   ),
 *
 *  @OA\Property(
 *     property="password",
 *     type="string",
 *     description="Senha. Somente é obrigatório no cadastro. Nas reposta essa esse valor será omitido"
 *   ),
 *
 *  @OA\Property(
 *     property="avatarUrl",
 *     type="string",
 *     description="URL do foto ou avatar do usuário"
 *   ),
 *
 *  @OA\Property(
 *     property="createdAt",
 *     type="string",
 *     description="Criado em"
 *   ),
 *
 *  @OA\Property(
 *     property="updatedAt",
 *     type="string",
 *     description="Alterado em"
 *   )
 * )
 */

/**
 * @OA\Schema(
 *   schema="UserDeleteAllPayload",
 *   title="UserDeleteAllPayload",
 *   required={"userIdAction"},
 *  @OA\Property(
 *     property="userIdAction",
 *     type="string",
 *     description="ID do usuario que está executando uma ação"
 *   )
 * )
 */
