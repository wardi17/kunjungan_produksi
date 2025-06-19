USE [um_db]
GO

/****** Object:  Table [dbo].[master_jenis_kunjungan]    Script Date: 6/19/2025 3:52:22 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[master_jenis_kunjungan](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[kode_kjn] [varchar](50) NULL,
	[nama_kunjungan] [varchar](150) NULL,
 CONSTRAINT [PK_master_jenis_kunjungan] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


