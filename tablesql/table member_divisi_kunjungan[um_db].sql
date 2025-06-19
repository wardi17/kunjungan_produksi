USE [um_db]
GO

/****** Object:  Table [dbo].[member_divisi_kunjungan]    Script Date: 6/19/2025 3:54:00 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[member_divisi_kunjungan](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[kode_divisi] [varchar](50) NULL,
	[nama] [varchar](50) NULL,
	[email] [varchar](150) NULL,
	[dateEntry] [datetime] NULL,
	[username] [varchar](50) NULL,
 CONSTRAINT [PK_member_divisi_kunjungan] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


