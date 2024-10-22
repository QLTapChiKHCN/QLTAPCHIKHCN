@extends('LayoutHome.master')

@section('content')
<section class="article-section">
    <div class="container">
        <div class="article-container">
            <!-- Article Header -->
            <header class="article-header">
                <div class="meta-category">Bài báo khoa học</div>
                <h1 class="article-title">{{ $baiViet->TieuDe }}</h1>
                <h2 class="article-subtitle">{{ $baiViet->TenBaiBao }}</h2>
                <div class="article-meta">
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>{{ date('d/m/Y', strtotime($baiViet->NgayXuatBan)) }}</span>
                    </div>
                </div>
            </header>

            <!-- Article Summary -->
            <div class="article-summary">
                <div class="summary-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
                <div class="summary-content">
                    <h3>Tóm tắt bài viết</h3>
                    <p>{{ $baiViet->TomTat }}</p>
                </div>
            </div>

            <!-- Article Actions -->
            <div class="article-actions">
                <button id="viewPdfBtn" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    <span>Xem File PDF</span>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- PDF Viewer Modal -->
<div id="pdfModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Xem tài liệu PDF</h3>
            <button class="close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div id="pdfContainer"></div>
    </div>
</div>

<style>
    .article-section {
        padding: 4rem 0;
        background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
        min-height: 100vh;
    }

    .article-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 16px;
        padding: 3rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                    0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .article-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .meta-category {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: #eef2ff;
        color: #4f46e5;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }

    .article-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1a202c;
        line-height: 1.3;
        margin-bottom: 1rem;
        letter-spacing: -0.5px;
    }

    .article-subtitle {
        font-size: 1.5rem;
        color: #4a5568;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .article-meta {
        display: flex;
        justify-content: center;
        gap: 2rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #718096;
    }

    .article-summary {
        background: #f8fafc;
        border-radius: 12px;
        padding: 2rem;
        margin: 2rem 0;
        display: flex;
        gap: 1.5rem;
    }

    .summary-icon {
        color: #4f46e5;
    }

    .summary-content h3 {
        color: #2d3748;
        font-size: 1.25rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .summary-content p {
        color: #4a5568;
        line-height: 1.8;
        font-size: 1.1rem;
    }

    .article-actions {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(4px);
    }

    .modal-content {
        background-color: #ffffff;
        margin: 2% auto;
        width: 90%;
        max-width: 1200px;
        height: 90%;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .modal-header h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1a202c;
        margin: 0;
    }

    .close {
        background: none;
        border: none;
        padding: 0.5rem;
        cursor: pointer;
        color: #64748b;
        transition: all 0.2s ease;
    }

    .close:hover {
        color: #1a202c;
        transform: rotate(90deg);
    }

    #pdfContainer {
        height: calc(100% - 70px);
        overflow: auto;
        padding: 2rem;
    }

    #pdfContainer canvas {
        margin: 0 auto 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
    }

    @media (max-width: 768px) {
        .article-container {
            padding: 2rem;
            margin: 1rem;
        }

        .article-title {
            font-size: 2rem;
        }

        .article-subtitle {
            font-size: 1.25rem;
        }

        .article-summary {
            flex-direction: column;
            padding: 1.5rem;
        }

        .modal-content {
            margin: 0;
            width: 100%;
            height: 100%;
            border-radius: 0;
        }
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewPdfBtn = document.getElementById('viewPdfBtn');
        const modal = document.getElementById('pdfModal');
        const closeBtn = document.getElementsByClassName('close')[0];
        const pdfContainer = document.getElementById('pdfContainer');
        const pdfUrl = "{{ asset('/public/storage/uploads/' . $baiViet->FileBaiViet) }}";

        // PDF Loading Indicator
        const loadingTemplate = `
            <div class="loading-indicator">
                <div class="loading-spinner"></div>
                <p>Đang tải PDF...</p>
            </div>
        `;

        viewPdfBtn.addEventListener('click', function() {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
            pdfContainer.innerHTML = loadingTemplate;
            loadPdf(pdfUrl);
        });

        closeBtn.addEventListener('click', closeModal);

        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                closeModal();
            }
        });

        function closeModal() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
            pdfContainer.innerHTML = '';
        }

        function loadPdf(url) {
            pdfjsLib.getDocument(url).promise.then(function(pdf) {
                const totalPages = pdf.numPages;
                const pagePromises = [];

                for (let pageNum = 1; pageNum <= totalPages; pageNum++) {
                    pagePromises.push(renderPage(pdf, pageNum));
                }

                Promise.all(pagePromises).then(() => {
                    const loadingIndicator = pdfContainer.querySelector('.loading-indicator');
                    if (loadingIndicator) {
                        loadingIndicator.remove();
                    }
                });
            }).catch(function(error) {
                console.error('Error loading PDF:', error);
                pdfContainer.innerHTML = `
                    <div class="error-message">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <p>Không thể tải PDF. Vui lòng thử lại sau.</p>
                    </div>
                `;
            });
        }

        async function renderPage(pdf, pageNum) {
            const page = await pdf.getPage(pageNum);
            const scale = 1.5;
            const viewport = page.getViewport({ scale: scale });
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = {
                canvasContext: context,
                viewport: viewport
            };

            await page.render(renderContext).promise;
            pdfContainer.appendChild(canvas);
        }
    });
</script>

<style>
   /* Loading và Error States */
.loading-indicator {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 200px;
    color: #4a5568;
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 3px solid #e2e8f0;
    border-top: 3px solid #4f46e5;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 1rem;
}

.error-message {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 200px;
    color: #ef4444;
    text-align: center;
    padding: 2rem;
}

.error-message svg {
    margin-bottom: 1rem;
    color: #ef4444;
}

.error-message p {
    font-size: 1.1rem;
    margin: 0;
}

/* Animations */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Page transitions */
.modal {
    animation: fadeIn 0.3s ease-out;
}

.modal-content {
    animation: slideUp 0.3s ease-out;
}

@keyframes slideUp {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* PDF Page Navigation */
.pdf-navigation {
    position: sticky;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(8px);
    padding: 1rem;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    border-top: 1px solid #e2e8f0;
}

.pdf-nav-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    color: #475569;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.pdf-nav-button:hover {
    background: #e2e8f0;
    color: #1e293b;
}

.pdf-nav-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.page-info {
    font-size: 0.875rem;
    color: #64748b;
}

/* Hover Effects */
.article-container {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.article-container:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.1);
}

/* Responsive Design Improvements */
@media (max-width: 640px) {
    .article-section {
        padding: 2rem 1rem;
    }

    .article-container {
        padding: 1.5rem;
    }

    .article-title {
        font-size: 1.75rem;
    }

    .article-subtitle {
        font-size: 1.1rem;
    }

    .article-meta {
        flex-direction: column;
        gap: 1rem;
    }

    .pdf-navigation {
        padding: 0.75rem;
    }

    .pdf-nav-button {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
}

/* Print Styles */
@media print {
    .article-section {
        padding: 0;
        background: none;
    }

    .article-container {
        box-shadow: none;
        padding: 0;
    }

    .article-actions,
    .modal {
        display: none !important;
    }
}

/* Accessibility Improvements */
.btn-primary:focus,
.close:focus,
.pdf-nav-button:focus {
    outline: 2px solid #4f46e5;
    outline-offset: 2px;
}

@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Custom Scrollbar */
#pdfContainer {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 #f1f5f9;
}

#pdfContainer::-webkit-scrollbar {
    width: 8px;
}

#pdfContainer::-webkit-scrollbar-track {
    background: #f1f5f9;
}

#pdfContainer::-webkit-scrollbar-thumb {
    background-color: #cbd5e1;
    border-radius: 4px;
    border: 2px solid #f1f5f9;
}
</style>
@endsection
