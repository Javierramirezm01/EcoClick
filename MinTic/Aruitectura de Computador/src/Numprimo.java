public class Numprimo {

    public static void main(String[] args) {

        try (Scanner obtenerNumero = new Scanner(System.in)) {

            int cont, i, a;

            System.out.print("Ingresa un número");

            a = obtenerNumero.nextInt();

            cont = 0;

            for(i = 1; i <= a; i++){

                if ((a % i) == 0){

                    cont++;

                }

                if(cont <= 2){

                    System.out.print(a + " El número es primo");

                }

                else{

                    System.out.print(a + " El número no es primo");

                }

            }
        }
    }
