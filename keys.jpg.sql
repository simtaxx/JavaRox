#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: users
#------------------------------------------------------------

CREATE TABLE users(
        id_user          Int  Auto_increment  NOT NULL ,
        pseudo_user      Varchar (30) NOT NULL ,
        password_user    Varchar (60) NOT NULL ,
        description_user Text NOT NULL ,
        picture_user     Varchar (40) NOT NULL ,
        mail_user        Varchar (100) NOT NULL ,
        website_user     Varchar (50) NOT NULL
	,CONSTRAINT users_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: topic
#------------------------------------------------------------

CREATE TABLE topic(
        id_topic     Int  Auto_increment  NOT NULL ,
        title_topic  Varchar (100) NOT NULL ,
        closed_topic Bool NOT NULL ,
        id_user      Int NOT NULL
	,CONSTRAINT topic_PK PRIMARY KEY (id_topic)

	,CONSTRAINT topic_users_FK FOREIGN KEY (id_user) REFERENCES users(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: post
#------------------------------------------------------------

CREATE TABLE post(
        id_post      Int  Auto_increment  NOT NULL ,
        title_post   Varchar (100) NOT NULL ,
        content_post Text NOT NULL ,
        date_post    Date NOT NULL ,
        id_user      Int NOT NULL ,
        id_topic     Int NOT NULL
	,CONSTRAINT post_PK PRIMARY KEY (id_post)

	,CONSTRAINT post_users_FK FOREIGN KEY (id_user) REFERENCES users(id_user)
	,CONSTRAINT post_topic0_FK FOREIGN KEY (id_topic) REFERENCES topic(id_topic)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commentaires
#------------------------------------------------------------

CREATE TABLE commentaires(
        id_comment      Int  Auto_increment  NOT NULL ,
        title_comment   Varchar (100) NOT NULL ,
        content_comment Text NOT NULL ,
        id_post         Int NOT NULL ,
        id_user         Int NOT NULL
	,CONSTRAINT commentaires_PK PRIMARY KEY (id_comment)

	,CONSTRAINT commentaires_post_FK FOREIGN KEY (id_post) REFERENCES post(id_post)
	,CONSTRAINT commentaires_users0_FK FOREIGN KEY (id_user) REFERENCES users(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: aimer
#------------------------------------------------------------

CREATE TABLE aimer(
        id_user Int NOT NULL ,
        id_post Int NOT NULL
	,CONSTRAINT aimer_PK PRIMARY KEY (id_user,id_post)

	,CONSTRAINT aimer_users_FK FOREIGN KEY (id_user) REFERENCES users(id_user)
	,CONSTRAINT aimer_post0_FK FOREIGN KEY (id_post) REFERENCES post(id_post)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: liker
#------------------------------------------------------------

CREATE TABLE liker(
        id_comment Int NOT NULL ,
        id_user    Int NOT NULL
	,CONSTRAINT liker_PK PRIMARY KEY (id_comment,id_user)

	,CONSTRAINT liker_commentaires_FK FOREIGN KEY (id_comment) REFERENCES commentaires(id_comment)
	,CONSTRAINT liker_users0_FK FOREIGN KEY (id_user) REFERENCES users(id_user)
)ENGINE=InnoDB;

