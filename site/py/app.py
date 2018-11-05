import pymysql

from menuMaterial import MenuMaterial

conexion = pymysql.connect("localhost","gus","1234","joyeria")
cursor = conexion.cursor()

while True:
    print("")
    print("   *   *  *****  *   *  *   *  ")
    print("   ** **  *      **  *  *   *  ")
    print("   * * *  *****  * * *  *   *  ")
    print("   *   *  *      *  **  *   *  ")
    print("   *   *  *****  *   *  *****  ")
    print("")
    print("1) Almacen")
    print("2) Material")
    print("3) Perfil")
    print("4) Empleado")
    print("5) Registro")
    print("0) Salir ")
    print("Elige una opcion: ")
    op=input()
    
    if op == "1":
        MenuMaterial(conexion,cursor)
        
    elif op == "2":
        MenuMaterial(conexion,cursor) 
        
    elif op == "0":
        conexion.close()
        break


