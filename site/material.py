class Material:
    def __init__(self, conexion, cursor):
        self.c = conexion
        self.cur = cursor
        
    def agregar(self,name,quilataje,peso,id_Almacen):
        insertar = ("INSERT INTO material(name,quilataje,peso,id_Almacen)VALUES (%s,%s,%s,%s)")
        self.cur.execute(insertar,(name,quilataje,peso,id_Almacen))
        self.c.commit()
        
    def buscar(self,name,id_Almacen):
        busqueda = ("SELECT * FROM material WHERE name = %s and id_Almacen = %s")
        self.cur.execute(busqueda,(name,id_Almacen))
        resultados = self.cur.fetchall()
        
        return resultados
    
    def modificar(self,name,id_material):
        modifica = ("UPDATE material SET name = %s quilataje = %s peso = %s WHERE id = %s")
        self.cur.execute(modifica,(name,id_material))
        self.c.commit()
        
    def eliminar(self,name,id_material):
        elimina = ("DELETE FROM material WHERE name = %s and id = %s")
        self.cur.execute(elimina,(name,id_material))
        self.c.commit()
        
    def buscar_id(self,id_Almacen):
        busqueda = ("SELECT * FROM material WHERE id_Almacen = %s")
        self.cur.execute(busqueda,(id_Almacen,))
        resultados = self.cur.fetchall()
        
        return resultados