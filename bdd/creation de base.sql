create database cmds;
use cmds;

create table client ( 
					numcli smallint, 
					nomcli varchar(100), 
					prenomcli varchar(50), 
					telcli char(10), 
					emailcli varchar(60), 
					primary key (numcli)
);

create table adressecli (
					adresse varchar(100), 
					numero smallint,
					cp smallint,
					ville varchar (50),
					pays varchar(50),
					numCli smallint,
					foreign key (numcli)
					references client (numcli));
	
create table commande (	
					numcommande smallint,
					numcli smallint,
					datecom DATE,
					primary key (numcommande),
					foreign key (numcli)
					references client (numcli) );
					
create table facture (
					numfacture int, 
					numcommande smallint, 
					datefac DATE, 
					primary key (numfacture,numcommande), 
					foreign key (numcommande)
					references commande(numcommande) );
					
create table tauxtva (
					codetva int, 
					tva float,
					primary key (codetva));
	
	
create table produit (
					numproduit smallint,
					libelle varchar (50),
					prix decimal(10,2),
					codetva int,
					stock int, 
					stocklimite int,
					primary key (numproduit),
					foreign key (codetva)
					references tauxtva(codetva));
					
	create table detailcommande (
					numcommande smallint,
					numproduit smallint,
					quantite smallint,
					primary key (numcommande,numproduit),
					foreign key (numcommande)
					references commande(numcommande),
					foreign key (numproduit) references produit(numproduit) ) ;
					
create table fournisseur ( 
					numfour smallint,
					nomfour varchar (50),
					adressefour varchar (100),
					telfour char (10),
					primary key (numfour));
					
create table commandefour(
					numcomfour smallint,
					numfour smallint,
					datecomfour DATE,
					primary key (numcomfour),
					foreign key (numfour)
					references fournisseur (numfour) );
					
					

	
create table detailcommandefour (
					numcomfour smallint,
					numproduit smallint,
					quantite smallint,
					primary key (numcomfour, numproduit),
					foreign key (numcomfour)
					references commandefour(numcomfour),
					foreign key (numproduit) references produit(numproduit) );
