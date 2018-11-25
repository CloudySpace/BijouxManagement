class Perfil:
    def __init__(self, conexion, cursor):
        self.c = conexion
        self.cur = cursor
        
    def agregar(self,name,):
        insertar = ("INSERT INTO perfil(name)VALUES (%s)")
        self.cur.execute(insertar,(name,))
        self.c.commit()
        
    def eliminar(self,name,):
        elimina = ("DELETE FROM perfil WHERE  name = %s")
        self.cur.execute(elimina,(name,))
        self.c.commit()
        
    def buscar(self,id_perfil):
        busqueda = ("SELECT * FROM perfil WHERE id = %s)
        self.cur.execute(busqueda,(id_perfil,))
        resultados = self.cur.fetchall()
        
        return resultados
    
    def modificar(self,name,id_perfil):
        modifica = ("UPDATE perfil SET name = %s WHERE id = %s")
        self.cur.execute(modifica,(name,id_perfil))
        self.c.commit()