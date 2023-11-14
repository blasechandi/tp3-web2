API-RESTFULL COMO CONSUMIR ESTA API : Pueba con postman

El endpoint de la API es: http://localhost/tucarpetalocal/TP3-API/api/periferico
El endpoint de la API es: http://localhost/tucarpetalocal/TP3-API/api/categoria

Integrantes: Blas Echandi, Thomas Bandeo.
Emails: blasechandi11@gmail.com, thomas-bandeo@hotmail.com.


ACLARACION 1: No realizamos el punto 3 de los requerimientos obligatorios, ya que 
implementamos el punto 9 que es mas completo.

ACLARACION 2: Al momento de eliminar una categoria, si existen perifericos de ese tipo de categoria, no te va a dejar y va a dar un error porque la restriccion de categorias esta en RESTRICT, si queres eliminar una categoria primero debes eliminar todos los perifericos que pertenecen a esa categoria. 

ACLARACION 3: Al updatear una categoria, se va a cambiar de la tabla perifericos, su tipo_periferico que pertenecen a esa categoria.

//Esto para la tabla perifericos
Method = GET ,      URL = api/periferico => lista todos los perifericos
Method = GET ,      URL = api/periferico?sort=filtroA&ord=filtroB => lista los perifericos por un campo ordenado de forma asc o desc 
Method = GET ,      URL = api/periferico?marca=filtroA => lista los perifericos filtrados por una marca especifica
Method = GET ,      URL = api/periferico/id => muestra un periferico por id
Method = DELETE ,   URL = api/periferico/id => Elimina un periferico por id
Method = POST ,     URL = api/periferico => crea un periferico
Method = PUT ,      URL = api/periferico/id => edita un periferico por id


//Esto para la tabla categorias
Method = GET ,      URL = api/categoria => lista todos los categoria
Method = GET ,      URL = api/categoria?sort=filtroA&ord=filtroB => lista los categoria por un campo ordenado de forma asc o desc 
Method = GET ,      URL = api/categoria?id_periferico=filtroA => lista los categoria filtrados por una marca especifica
Method = GET ,      URL = api/categoria/id => muestra un categoria por id
Method = DELETE ,   URL = api/categoria/id => Elimina un categoria por id
Method = POST ,     URL = api/categoria => crea un categoria
Method = PUT ,      URL = api/categoria/id => edita un categoria por id


//Esto para el token, el usuario y contraseña son de la tabla usuarios
Method = GET ,      URL = api/user/token => para generar el token debes poner usuario="webadmin" y contraseña = "admin"


