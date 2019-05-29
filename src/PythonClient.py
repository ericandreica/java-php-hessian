from pyhessian.client import HessianProxy

class ExecHessClie:
    def __init__(self, urlServ):
        print ("Hessian Python Client: " + urlServ)
        var = '1'
        proxy = HessianProxy(urlServ)
        while (var != '0'):
            self.menu()
            var = input("Option: ")
            if (var == '0'):
                print ("Exit...")
            elif (var == '1'):
                print ("Files: " + proxy.listAll())
            elif (var == '2'):
                name = input("File name: ")
                print ("Result: " + proxy.getByName(name))
            elif (var == '3'):
                contentString = input("Content: ")
                print ("Result: "+proxy.getByContentString(contentString))
            elif (var == '4'):
                contentBytes = input("Content: ")
                print ("Result: "+proxy.getByContentBytes(contentBytes))
            elif (var == '5'):
                hash = input("Hash: ")
                print ("Result: "+proxy.getByHash(hash))
            else:
                print ("Bad input\n")


    def menu(self):
        print("1:List")
        print("2:Get by name")
        print("3:Search by content as string")
        print("4:Search by content as bytes")
        print("5:Search by hash")
        print("0:Exit")

try:
    ExecHessClie("http://localhost:9090/hess")
    #ExecHessClie("http://localhost/PHPServer.php")
except:
    print ("Error")
