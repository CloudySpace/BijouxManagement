class Empleado:
    def __init__(self, conexion, cursor):
        self.c = conexion
        self.cur = cursor
        
    def agregar(self,id_perfil,name,username,password,id_Almacen):
        insertar = ("INSERT INTO empleado(id_perfil,name,username,password,id_Almacen)VALUES (%s,%s,%s,%s,%s)")
        self.cur.execute(insertar,(id_perfil,name,username,password,id_Almacen))
        self.c.commit()
        
    def eliminar(self,name,id_empleado):
        elimina = ("DELETE FROM empleado WHERE name = %s and id = %s")
        self.cur.execute(elimina,(name,id_empleado))
        self.c.commit()
        
    def buscar(self,id_empleado):
        busqueda = ("SELECT * FROM empleado WHERE id = %s)
        self.cur.execute(busqueda,(id_empleado,))
        resultados = self.cur.fetchall()
        
        return resultados
    
    def modificar(self,id_perfil,name,username,password,id_Almacen,id_empleado):
        modifica = ("UPDATE empleado SET id_perfil = %s name = %s username = %s password = %s id_Almacen = %s WHERE id = %s")
        self.cur.execute(modifica,(id_perfil,name,username,password,id_Almacen,id_empleado))
        self.c.commit()