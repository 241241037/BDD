<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    "sqlite:srvbd.db",
    // usuario
    null,
    // contraseña
    null,
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS KJREVISTAS (
      KJ_ID INTEGER,
      KJ_NOMBRE TEXT NOT NULL,
      KJ_EDITORIAL TEXT NOT NULL,
      KJ_GENERO TEXT NOT NULL,
      CONSTRAINT KJ_PK
          PRIMARY KEY(KJ_ID),
      CONSTRAINT KJ_NOMBRE_UNQ
          UNIQUE(KJ_NOMBRE),
      CONSTRAINT KJ_NOMBRE_NV
          CHECK(LENGTH(KJ_NOMBRE) > 0),
      CONSTRAINT KJ_EDITORIAL_NV
          CHECK(LENGTH(KJ_EDITORIAL) > 0),
      CONSTRAINT KJ_GENERO_NV
          CHECK(LENGTH(KJ_GENERO) > 0)
  )"
   );
  }

  return self::$pdo;
 }
}
