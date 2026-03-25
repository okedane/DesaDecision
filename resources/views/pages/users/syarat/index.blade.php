<x-app>
    <div class="page">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2>Form Data Pelamar</h2>
                    <p>Lengkapi data berikut dengan benar.</p>
                </div>

                <form action="{{ route('pelamar.store') }}" method="POST" enctype="multipart/form-data" class="form-body">
                    @csrf

                    <section class="section">
                       

                        <section class="section">
                            <h3>Persyaratan Berkas</h3>
                            <div class="grid-2">
                                <div>
                                    <label>KTP <span class="required">*</span></label>
                                    <input type="file" name="ktp" required>
                                </div>

                                <div>
                                    <label>Ijazah Terakhir <span class="required">*</span></label>
                                    <input type="file" name="ijazah_terakhir" required>
                                </div>

                                <div>
                                    <label>Pas Foto 3x4 <span class="required">*</span></label>
                                    <input type="file" name="pas_foto_3x4" required>
                                </div>

                                <div>
                                    <label>CV <span class="required">*</span></label>
                                    <input type="file" name="cv" required>
                                </div>

                                <div class="full">
                                    <label>Surat Keterangan Sehat <span class="required">*</span></label>
                                    <input type="file" name="surat_keterangan_sehat" required>
                                </div>
                            </div>
                        </section>
                    </section>

                    <button type="submit" class="btn-submit">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>

      <style>
        .page {
            min-height: 100vh;
            background: #f8fafc;
            padding: 40px 16px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.05);
            overflow: hidden;
        }

        .card-header {
            padding: 24px 28px;
            border-bottom: 1px solid #e2e8f0;
            background: linear-gradient(to right, #eff6ff, #eef2ff);
        }

        .card-header h2 {
            margin: 0;
            font-size: 24px;
            color: #1e293b;
        }

        .card-header p {
            margin-top: 6px;
            color: #64748b;
            font-size: 14px;
        }

        .form-body {
            padding: 24px 28px;
        }

        .section {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 18px;
        }

        .section h3 {
            margin: 0 0 14px 0;
            color: #1e293b;
            font-size: 18px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .full {
            grid-column: 1 / -1;
        }

        @media (min-width: 768px) {
            .grid-2 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #334155;
            font-weight: 600;
            font-size: 14px;
        }

        .required {
            color: #ef4444;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 14px;
            background: #fff;
            box-sizing: border-box;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .foto-wrap {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        @media (min-width: 640px) {
            .foto-wrap {
                flex-direction: row;
                align-items: center;
            }
        }

        .foto-preview {
            width: 96px;
            height: 96px;
            border-radius: 9999px;
            border: 2px dashed #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 13px;
            flex-shrink: 0;
            background: #fff;
        }

        .hint {
            margin: 0 0 8px 0;
            color: #64748b;
            font-size: 13px;
        }

        .btn-submit {
            width: 100%;
            border: 0;
            border-radius: 10px;
            padding: 12px 16px;
            background: #2563eb;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-submit:hover {
            background: #1d4ed8;
        }
    </style>
</x-app>