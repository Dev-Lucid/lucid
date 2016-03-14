<?php

namespace DevLucid;

interface SecurityInterface
{
    public function isLoggedIn(): bool;
    public function requireLogin();

    public function hasPermission(string ...$names): bool;
    public function requirePermission(string ...$names);

    public function hasAnyPermission(string ...$names): bool;
    public function requireAnyPermission(string ...$names);

    public function hasSession($name, $value): bool;
    public function requireSession($name, $reqValue);
    
    public function grant(string ...$names);
    public function revoke(string ...$names);

    public function getPermissionsList(): array;
    public function setPermissionsList(array $names);

    public function __call($name, $parameters);
}
