# vinilos-rest

Integrantes: Maia González (gonzalezmaia01@gmail.com) Nahuel Gulias (guliasnahuel07@gmail.com) Temática: Vinilos y Artistas. El proyecto consiste en la comercialización de vinilos, por lo tanto, el usuario podrá consultar sobre mismos, como también, indagar sobre su artista seleccionado. Siendo así, nuestra tabla principal será la de Vinilos, en la cual la Foreign Key será la columna “id_artista”, que se conectará con la segunda tabla “Artistas” con su Primary Key en la columna “id_artista”.

url_ejemplo: ./api/endpoint/:ID/:subrecurso
ENDPOINTS:

GET || /api/vinilos                  Devuelve todos los vinilos. En el caso de especificar las querys de 'campo' y 'orden', se obtienen ordenados.
GET || /api/vinilos/:ID              Devuelve el vininilo con el id solicitado.
GET || /api/vinilos/:ID/subrecurso   Devuelve el valor del campo del vinilo especificado.
POST|| /api/vinilos                  Inserta el vinilo con la informacion dada mediante un JSON en el body. Se completan todos los campos ("vinilo", "anio_lanzamiento", "precio", "id_artista") exceptuando el id.
PUT|| /api/vinilos/:ID               Modifica el vinilo solicitado, obteniendo la informacion mediante un JSON en el body, se completan los campos "precio" y "id_vinilo".

Esto se repite con /api/artistas .
