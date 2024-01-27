T¨2 - Exercice XML

#TP 2 -  Exercice XML

Soit la DTD Suivante :

```XML
<!ELEMENT entete (titre, date, auteur+, motscles*, resume?)>
<!ELEMENT titre (#PCDATA)>
<!ELEMENT date (#PCDATA)>
<!ELEMENT auteur (#PCDATA)>
<!ELEMENT motscles (#PCDATA)>
<!ELEMENT resume (paragraphe+)>
<!ELEMENT paragraphe (#PCDATA)>
```

***

1. Produire un document XML valide par rapport à cette DTD
2. Le document suivant est-il valide par rapport à la DTD ?

```XML
<?xml version="1.0"?>
<!DOCTYPE entete SYSTEM "entete.dtd">
<entete>
  <titre>Mon document</titre>
  <date>Aujourd'hui</date>
  <auteur>Moi</auteur>
</entete>
```

***
*[Exercice plus qu'inspiré de ce site ;) ](https://stph.scenari-community.org/lo17/xml/co/dtdUE01.html)
