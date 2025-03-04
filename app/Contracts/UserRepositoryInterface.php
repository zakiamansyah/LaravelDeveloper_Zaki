<?php

namespace App\Contracts;

interface UserRepositoryInterface
{

    public function all();

    public function getPaginatedForDatatables($request, $limit, $offset);

    public function create ( $request );

    public function delete( $id );

    public function show( $id );

    public function allPublished();

    public function update( $id, $request);
}
