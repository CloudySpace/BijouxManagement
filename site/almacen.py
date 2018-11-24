class Almacen:
    def __init__(self, conexion, cursor):
        self.c = conexion
        self.cur = cursor
        
    def crearAlmacen(self,nombre,ubicacion):
        insertar = ("INSERT INTO almacen(nombre, ubicacion) VALUES(%s,%s)")
        self.cur.execute(insertar, (nombre,ubicacion))
        self.c.commit()
        
    def getAlmacen(self, user, password):
        select_usuario = \
        ("SELECT id FROM empleado WHERE username = %s AND password = %s")
                         
        self.cur.execute(select_usuario,(user,password))
        id = self.cur.fetchall()
        
        lista = []
        if id:
            id = id[0][0]
            print('id_Almacen',id)
            
            select_empleado_almacen = \
            ("SELECT id_Almacen FROM trabajador WHERE id_trabajador = %s")
            self.cur.execute(select_empleado_almacen,(id, ))
            almacen_id = self.cur.fetchall()
            
            print('id_almacen', almacen_id)
            
            for i  in almacen_id:
                almace = i[0]
                
                select_almacen = \
                ("SELECT * FROM almacen WHERE id = %s")
                self.cur.execute(select_almacen, (almace,))
                res = self.cur.fetchall()
                print(res)
                
                if res:
                    select_material = ("SELECT COUNT(id) FROM material WHERE id_Almacen=%s")
                    self.cur.execute(select_material,(res[0][0],))
                    materiales = self.cur.fetchall()
                    
                    almacen = {
                        'id': res[0][0],
                        'name': res[0][1],
                        'ubicacion': res[0][2],
                        'materiales': materiales
                    }
                    
                    lista.append(almacen)
            return lista

    def getMateriales(self,id_almacen):
        materiales = ("SELECT * FROM material WHERE id_Almacen = %s")
        self.cur.execute(materiales,(id_almacen,))
        res = self.cur.fetchall()
        lista = []
        
        print(res)
        
        for i in res:
            select_material = {
                'Id' : i[0],
                'name': i[1],
                'quilataje': i[2],
                'peso':i[3],
                'id_Almacen':i[4]
            }
            
            lista.append(select_material)
            print(lista)
        return lista