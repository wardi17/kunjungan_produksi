USE [um_db]
GO

/****** Object:  Table [dbo].[kunjungan_produksi]    Script Date: 6/19/2025 3:55:45 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[kunjungan_produksi](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[tanggal] [datetime] NULL,
	[id_kunjungan] [varchar](50) NULL,
	[tujuan] [varchar](500) NULL,
	[temuan] [text] NULL,
	[divisi] [varchar](150) NULL,
	[divisi_terkait] [varchar](150) NULL,
	[peserta] [varchar](200) NULL,
	[jenis_ktg] [varchar](150) NULL,
	[image1] [varchar](100) NULL,
	[image2] [varchar](100) NULL,
	[image3] [varchar](100) NULL,
	[image4] [varchar](100) NULL,
	[ket] [text] NULL,
	[tanggal_proses] [datetime] NULL,
	[ket_proses] [varchar](300) NULL,
	[status_proses] [int] NULL,
	[tanggal_selesai] [datetime] NULL,
	[ket_selesai] [varchar](300) NULL,
	[status_selesai] [int] NULL,
	[tanggal_email] [datetime] NULL,
	[pesan_email] [varchar](300) NULL,
	[status_email] [int] NULL,
 CONSTRAINT [PK_kunjungan_produksi] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [dbo].[kunjungan_produksi] ADD  CONSTRAINT [DF_kunjungan_produksi_status_proses]  DEFAULT (0) FOR [status_proses]
GO

ALTER TABLE [dbo].[kunjungan_produksi] ADD  CONSTRAINT [DF_kunjungan_produksi_status_selesai]  DEFAULT (0) FOR [status_selesai]
GO

ALTER TABLE [dbo].[kunjungan_produksi] ADD  CONSTRAINT [DF_kunjungan_produksi_status_email]  DEFAULT (0) FOR [status_email]
GO


