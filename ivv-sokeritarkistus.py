# Nina tässä luo ekaa Ihan-vaan-Viisi -projektin funktioo 28.01.2022. 
# Funkion tarkoitus: Kysyy käyttäjältä sokeriarvoa ja vertaa sitä tietoihin.
import sys
# Luo funktio, joka toimii loopissa kunnes arvo on annettu oikein.
def sokeri_tarkistus(sokeriarvo):
    while True:
        if "," in sokeriarvo:
            sokerimpiarvo = ""
            for i in sokeriarvo:
                if i == ",":
                    sokerimpiarvo = sokerimpiarvo + "."
                else:
                    sokerimpiarvo = sokerimpiarvo + i
            sokeriarvo = sokerimpiarvo
        # Jos arvo on pistettävissä float muotoon se verrataan valmiisiin arvoihin
        # ja jos käyttäjä onkin syöttänyt kirjaimia, ohjelma antaa asianmukaisen 
        # palautteen.
        try:
            sokeriarvo = float(sokeriarvo)
            if sokeriarvo <= 4:
                #print("Arvo on alhainen: Jos sokerisi vielä laskevat, saatat joutua sairaalaan. Tämän vältät syömällä jotain, joka nostaa sokeriasi.")
                merkinta = 4
            elif 4.1 <= sokeriarvo <= 6:
                #print("Arvo on normaali. Hyvä!")
                merkinta = 3
            elif 6.1 <= sokeriarvo <= 6.9:
                #print("Arvo on kohonnut. Vältä sokerien nostavien ruokien syömistä hetkeen.")
                merkinta = 2
            elif 7 <= sokeriarvo:
                #print("Arvo on korkea. Käytäthän insuliinia lääkärin ohjeen mukaisesti ja jos se ei auta soita 112.")
                merkinta = 1
            break
        except ValueError:
            merkinta = 5
    print(merkinta)

sokeri_tarkistus(sys.argv[1])
"""
    # Muokkaa tätä lisää myöhemmin:      


    if merkinta == 3:
        print(f"{sokeriarvo} on vihreällä kalenterissa")
    elif merkinta == 1:
        print(f"{sokeriarvo} on punaisena kalenterissa")
    else:
        print(f"{sokeriarvo} on keltaisella kalenterissa")
"""

