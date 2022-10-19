/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  19/10/2022 12:14:39                      */
/*==============================================================*/


drop table if exists MARQUE;

drop table if exists PRODUIT;

/*==============================================================*/
/* Table : MARQUE                                               */
/*==============================================================*/
create table MARQUE
(
   IDMARQUE             int not null,
   primary key (IDMARQUE)
);

/*==============================================================*/
/* Table : PRODUIT                                              */
/*==============================================================*/
create table PRODUIT
(
   IDPRODUIT            int not null,
   IDMARQUE             int not null,
   primary key (IDPRODUIT)
);

alter table PRODUIT add constraint FK_POSSEDE foreign key (IDMARQUE)
      references MARQUE (IDMARQUE) on delete restrict on update restrict;

