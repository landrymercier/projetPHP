import java.util.Scanner;

/**
 * Created by Landry MERCIER on 23/05/2016.
 */
public class TPCelsiusFahrenheit {
    public static void main (String args[]){
        double saisieCelsius=0;
        double saisieFahrenheit=0;
        char choix='0';

        Scanner sc=new Scanner(System.in);

        while(choix!='C' && choix!='F') {
            System.out.println("Votre choix \""+choix+"\" n'est pas reconnu !");
            System.out.println("Choisissez une conversion : C/F");
            choix = sc.nextLine().charAt(0);
        }

        System.out.println("Vous avez choisi "+choix+" !");

        if (choix == 'C') {
            System.out.println("Saisissez votre température en Fahrenheit :");
            saisieFahrenheit=sc.nextDouble();
            System.out.println("Vous avez saisi "+saisieFahrenheit+"°F");
            fahrenheitVersCelsius(saisieFahrenheit);
        } else if (choix == 'F') {
            System.out.println("Saisissez votre température en Celsius :");
            saisieCelsius=sc.nextDouble();
            System.out.println("Vous avez saisi "+saisieCelsius+"°C");
            celsiusVersFahrenheit(saisieCelsius);
        }
    }

    public static double celsiusVersFahrenheit(double saisieCelsius){
        double convertionFahrenheit=((9.0/5.0)*saisieCelsius)+32.0;
        System.out.println(+saisieCelsius+"°C est égale à "+convertionFahrenheit+"°F !");
        return convertionFahrenheit;
    }

    public static double fahrenheitVersCelsius(double saisieFahrenheit){
        double convertionCelsius=((saisieFahrenheit-32)*5)/9;
        System.out.println(+saisieFahrenheit+"°F est égale à "+convertionCelsius+"°C !");
        return convertionCelsius;
    }
}
