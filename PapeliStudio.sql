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
    SELECT Usu_Nombres, Usu_Contrasena, Usu_Rol_Id
    FROM Usu_Usuario
    WHERE Usu_Email = @Email;
END;

Create procedure usp_Vip
	@Email VARCHAR (150)
As
Begin
	set nocount on;
	update Usu_Usuario
	set
	Usu_Rol_Id=2
	where Usu_Email=@Email
end


CREATE TABLE PRODUCTOS
(
PRO_ID INT IDENTITY(1,1) PRIMARY KEY,
PRO_NOM VARCHAR (255) NOT NULL,
PRO_DES VARCHAR (MAX) NOT NULL,
PRO_PRE DECIMAL (10,2) NOT NULL,
PRO_IMG VARCHAR (255) NOT NULL,
)


INSERT INTO PRODUCTOS (PRO_NOM, PRO_DES, PRO_PRE, PRO_IMG)
VALUES
('Cake Topper', 'Diseñamos el cake topper de tu preferencia.', 5000.00, 'cake topper 1.png'),
('Taza Sublimada', 'Taza sublimada personalizada.', 6000.00, 'Taza 1.png'),
('Invitación', 'Invitaciones impresas y digitales.', 2500.00, 'Invitacion 1.png');
GO


CREATE TABLE  PEDIDOS
(
PED_ID INT IDENTITY (1,1) PRIMARY KEY,
PED_USU_ID INT NOT NULL,
PED_PRO_ID INT NOT NULL,
PED_CANTIDAD INT NOT NULL,
PED_COMENTARIO VARCHAR (MAX) NOT NULL,
PED_FECHA DATETIME DEFAULT GETDATE (),
foreign key (PED_USU_ID) REFERENCES Usu_Usuario (Usu_Id),
foreign key (PED_PRO_ID) REFERENCES PRODUCTOS (PRO_ID)
)


CREATE PROCEDURE usp_ObtenerProductoSimple
    @Pro_Id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    SELECT PRO_ID, PRO_NOM, PRO_DES, PRO_PRE, PRO_IMG
    FROM PRODUCTOS
    WHERE PRO_ID = @Pro_Id;
END;


CREATE PROCEDURE usp_RegistrarPedidoSimple
    @Usu_Id INT,
    @Pro_Id INT,
    @Cantidad INT,
    @Comentario VARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO PEDIDOS 
    (PED_USU_ID, PED_PRO_ID, PED_CANTIDAD, PED_COMENTARIO)
    VALUES 
    (@Usu_Id, @Pro_Id, @Cantidad, @Comentario);
     
    SELECT SCOPE_IDENTITY() AS NuevoPedidoId;
END;


CREATE PROCEDURE usp_ObtenerUsuarioId
    @Email VARCHAR(150)
AS
BEGIN
    SET NOCOUNT ON;
    
    SELECT Usu_Id
    FROM Usu_Usuario
    WHERE Usu_Email = @Email;
END;







SELECT * FROM PEDIDOS

IF OBJECT_ID('usp_LoginUsuario', 'P') IS NOT NULL
    DROP PROCEDURE usp_LoginUsuario;
GO

CREATE PROCEDURE usp_LoginUsuario
    @Email VARCHAR(150)
AS
BEGIN
    SET NOCOUNT ON;
    SELECT Usu_Nombres, Usu_Contrasena, Usu_Rol_Id
    FROM Usu_Usuario
    -- Usamos TRIM() para asegurar que la búsqueda sea correcta
    WHERE TRIM(Usu_Email) = TRIM(@Email); 
END;
GO







