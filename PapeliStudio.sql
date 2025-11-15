CREATE TABLE Rol_Rol
(
	Rol_Id int identity(1,1) primary key not null,
	Rol_Tipo varchar(20) not null
)
insert into Rol_Rol
(
Rol_Tipo
)
values
(
'Estandar'
)
insert into Rol_Rol
(
Rol_Tipo
)
values
(
'Vip'
)
CREATE TABLE Usu_Usuario 
(
    Usu_Id INT IDENTITY(1,1) PRIMARY KEY,
    Usu_Nombres VARCHAR(100) NOT NULL,
    Usu_Apellidos VARCHAR(100) NOT NULL,
    Usu_Rut VARCHAR(12) NOT NULL UNIQUE,
    Usu_Email VARCHAR(150) NOT NULL UNIQUE,
    Usu_Fono VARCHAR(20) NOT NULL,
	Usu_Contrasena VARCHAR(255),
    Usu_FechaRegistro DATETIME DEFAULT GETDATE(),
	Usu_Rol_Id INT NOT NULL Default (1),
    foreign key (Usu_Rol_Id) REFERENCES Rol_Rol(Rol_Id)
);


CREATE PROCEDURE usp_RegistrarUsuario
    @Nombres VARCHAR(100),
    @Apellidos VARCHAR(100),
    @Rut VARCHAR(12),
    @Email VARCHAR(150),
    @Fono VARCHAR(20),
	@Contrasena VARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO Usu_Usuario (Usu_Nombres, Usu_Apellidos, Usu_Rut, Usu_Email, Usu_Fono,Usu_Contrasena)
    VALUES (@Nombres, @Apellidos, @Rut, @Email, @Fono,@Contrasena);
END;

CREATE PROCEDURE usp_LoginUsuario
    @Email VARCHAR(150)
AS
BEGIN
    SET NOCOUNT ON;
    SELECT Usu_Nombres, Usu_Contrasena
    FROM Usu_Usuario
    WHERE Usu_Email = @Email;
END;

select * from Usu_Usuario

