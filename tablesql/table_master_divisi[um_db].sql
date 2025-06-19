USE [um_db]
GO

/****** Object:  Table [dbo].[master_divisi]    Script Date: 6/19/2025 3:50:42 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[master_divisi](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[kode_divisi] [varchar](50) NULL,
	[nama_divisi] [varchar](150) NULL,
 CONSTRAINT [PK_master_divisi] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


