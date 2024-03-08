<footer class="main-footer bg-success">
    <div class="row">
        <div class="col-4">
            <div class="footer-section">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h5 style="font-weight: bold;">Deskripsi :</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ $profile->description }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4">
            <div class="footer-section">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h5 style="font-weight: bold;">Alamat :</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ $profile->address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4">
            <div class="footer-section">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6141317135243!2d123.03964167412352!3d0.5796671635690445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32792df761e3a791%3A0x1fac0920d086cbbe!2sApotek%20shafiyah!5e0!3m2!1sid!2sid!4v1708671573287!5m2!1sid!2sid"
                    width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</footer>
