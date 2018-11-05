from material import Material

class MenuMaterial:
    def __init__(self,conexion,cursor):
        self.mat = Material(conexion,cursor)
        while True:
            print("1) Agregar")
            print("2) Buscar")
            print("3) Modificar")
            print("4) Eliminar")
            print("0)salir")
            op=input()
            
            if op=="1":
                self.agregar()
                
            elif op=="2":
                self.buscar()
                
            elif op=="3":
                self.modificar()
                
            elif op=="4":
                self.eliminar()
                
            elif op=="0":
                break;
                
    def agregar(self):
        name=input("Nombre: ")
        quilataje=input("Quilataje: ")
        peso=input("Peso: ")
        id_Almacen=input("id_Almacen: ")
        self.mat.agregar(name,quilataje,peso,id_Almacen)
        
    def buscar(self):
        name=input("Nombre: ")
        id_Almacen=input("id_Almacen: ")
        resultados=self.mat.buscar(name,id_Almacen)
        
        print ("")
        for r in resultados:
            print ("│ {0:3} │ {1:30} │ {2:30} │ {3:30} │ {4:3} │".format (r[0],r[1],r[2],r[3],r[4] ))
            
        print ("") 
        
    def modificar(self):
        name=input("Nombre: ")
        id_material=input("id_material: ")
        self.mat.modificar(name,id_material)
        
    def eliminar(self):
        name=input("Nombre: ")
        id_material=input("id_material: ")
        self.mat.eliminar(name,id_material)