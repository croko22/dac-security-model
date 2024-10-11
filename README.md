# Implementación de Modelos de Seguridad: DAC (Discretionary access control)
Modelo de seguridad DAC aplicado a una app de notas compartidas

## Estructura 
- Politicas - [NotePolicy](https://github.com/croko22/dac-security-model/blob/main/app/Policies/NotePolicy.php): Se encarga de verificar permisos de lectura y escritura
- Base de datos
  - Tabla [NotePermissions](https://github.com/croko22/dac-security-model/blob/main/database/migrations/2024_10_09_030241_create_note_permissions_table.php): Nexo entre los usuarios y las notas compartidas con gestion de permisos

# Demostración del modelo
## Usuario dueño del documento
El usuario puede decidir que usuarios pueden acceder a esa nota con permisos de lectura y escritura
![alt text](https://github.com/croko22/dac-security-model/blob/main/docs/image.png)

## Notas compartidas
![alt text](https://github.com/croko22/dac-security-model/blob/main/docs/image-1.png)

## Nota con permiso de lectura
![alt text](https://github.com/croko22/dac-security-model/blob/main/docs/image-2.png)

## Nota con acceso denegado
![alt text](https://github.com/croko22/dac-security-model/blob/main/docs/image-3.png)