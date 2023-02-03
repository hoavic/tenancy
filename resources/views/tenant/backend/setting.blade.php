<x-tenapp-layout>
    <x-slot name="header">
        <h1 class="app-title">Cài đặt chung</h1>
    </x-slot>

    <div class="py-2 border-b">
        <ul class="flex gap-4">
            <li><a class="font-bold text-sm text-gray-500" href="#">Tổng quan</a></li>
            <li><a class="font-bold text-sm text-gray-500" href="#">Tài khoản</a></li>
            <li><a class="font-bold text-sm text-gray-500" href="#">Dự Án</a></li>
            <li><a class="font-bold text-sm text-gray-500" href="#">Giao diện</a></li>
            <li><a class="font-bold text-sm text-gray-500" href="#">Nâng cao</a></li>
        </ul>
    </div>

    <div class="py-2">
        <h2 class="font-bold">Tổng quan</h2>
        <small>Các thiết lập chung dành riêng cho bạn tại đây.</small>

    </div>

    <div data-litespeed-layout="cache" style="">
        <h3 class="litespeed-title-short">
            Cache cài đặt kiểm soát <a href="https://docs.litespeedtech.com/lscache/lscwp/cache/" target="_blank"
                class="litespeed-learn-more">Tìm hiểu thêm</a></h3>

        <table class="wp-list-table striped litespeed-table">
            <tbody>
                <tr>
                    <th>
                        Bật bộ nhớ đệm </th>
                    <td>
                        <input type="hidden" name="_settings-enroll[]" value="cache">
                        <div class="litespeed-switch"><input type="radio" autocomplete="off" name="cache"
                                id="input_radio_cache_0" value="0"> <label
                                for="input_radio_cache_0">TẮT</label><input type="radio" autocomplete="off"
                                name="cache" id="input_radio_cache_1" value="1" checked=""> <label
                                for="input_radio_cache_1">BẬT</label></div>
                        <div class="litespeed-desc">
                            Vui lòng truy cập trang <a
                                href="https://docs.litespeedtech.com/lscache/lscwp/installation/#testing"
                                target="_blank">Thông tin</a> về cách kiểm tra bộ nhớ cache.
                            <strong>CHÚ Ý: </strong>When disabling the cache, all cached entries for this site will be
                            purged.

                        </div>
                    </td>
                </tr>

                <tr>
                    <th>
                        Cache người dùng đã đăng nhập </th>
                    <td>
                        <input type="hidden" name="_settings-enroll[]" value="cache-priv">
                        <div class="litespeed-switch"><input type="radio" autocomplete="off" name="cache-priv"
                                id="input_radio_cachepriv_0" value="0"> <label
                                for="input_radio_cachepriv_0">TẮT</label><input type="radio" autocomplete="off"
                                name="cache-priv" id="input_radio_cachepriv_1" value="1" checked=""> <label
                                for="input_radio_cachepriv_1">BẬT</label></div>
                        <div class="litespeed-desc">
                            Các trang giao diện bộ nhớ cache riêng tư dành cho người dùng đã đăng nhập. (Yêu cầu LSWS
                            v5.2.1+) </div>
                    </td>
                </tr>

                <tr>
                    <th>
                        Cache người bình luận </th>
                    <td>
                        <input type="hidden" name="_settings-enroll[]" value="cache-commenter">
                        <div class="litespeed-switch"><input type="radio" autocomplete="off" name="cache-commenter"
                                id="input_radio_cachecommenter_0" value="0"> <label
                                for="input_radio_cachecommenter_0">TẮT</label><input type="radio" autocomplete="off"
                                name="cache-commenter" id="input_radio_cachecommenter_1" value="1" checked="">
                            <label for="input_radio_cachecommenter_1">BẬT</label></div>
                        <div class="litespeed-desc">
                            Cache một cách riêng tư cho các bình luận đang chờ xử lý. Tắt tùy chọn này thì máy chủ sẽ
                            không cache cho các trang có người bình luận. (Yêu cầu LSWS v5.2.1+) </div>
                    </td>
                </tr>

                <tr>
                    <th>
                        Cache REST API </th>
                    <td>
                        <input type="hidden" name="_settings-enroll[]" value="cache-rest">
                        <div class="litespeed-switch"><input type="radio" autocomplete="off" name="cache-rest"
                                id="input_radio_cacherest_0" value="0"> <label
                                for="input_radio_cacherest_0">TẮT</label><input type="radio" autocomplete="off"
                                name="cache-rest" id="input_radio_cacherest_1" value="1" checked=""> <label
                                for="input_radio_cacherest_1">BẬT</label></div>
                        <div class="litespeed-desc">
                            Yêu cầu bộ nhớ cache được thực hiện bởi các lệnh gọi REST API của WordPress. </div>
                    </td>
                </tr>

                <tr>
                    <th>
                        Cache trang đăng nhập </th>
                    <td>
                        <input type="hidden" name="_settings-enroll[]" value="cache-page_login">
                        <div class="litespeed-switch"><input type="radio" autocomplete="off"
                                name="cache-page_login" id="input_radio_cachepage_login_0" value="0"> <label
                                for="input_radio_cachepage_login_0">TẮT</label><input type="radio"
                                autocomplete="off" name="cache-page_login" id="input_radio_cachepage_login_1"
                                value="1" checked=""> <label for="input_radio_cachepage_login_1">BẬT</label>
                        </div>
                        <div class="litespeed-desc">
                            Vô hiệu hoá tùy chọn này có thể ảnh hưởng tiêu cực đến hiệu suất. </div>
                    </td>
                </tr>


                <tr>
                    <th>
                        Cache favicon.ico </th>
                    <td>
                        <input type="hidden" name="_settings-enroll[]" value="cache-favicon">
                        <div class="litespeed-switch"><input type="radio" autocomplete="off" name="cache-favicon"
                                id="input_radio_cachefavicon_0" value="0"> <label
                                for="input_radio_cachefavicon_0">TẮT</label><input type="radio" autocomplete="off"
                                name="cache-favicon" id="input_radio_cachefavicon_1" value="1" checked="">
                            <label for="input_radio_cachefavicon_1">BẬT</label></div>
                        <div class="litespeed-desc">
                            favicon.ico được yêu cầu trên hầu hết các trang. Cache tài nguyên này có thể cải thiện hiệu
                            suất máy chủ bằng cách tránh các lệnh gọi PHP không cần thiết. <br>
                            <font class="litespeed-primary">⚠️ Cài đặt này sẽ chỉnh sửa tập tin .htaccess. <a
                                    href="https://docs.litespeedtech.com/lscache/lscwp/toolbox/#edit-htaccess-tab"
                                    target="_blank" class="litespeed-learn-more">Tìm hiểu thêm</a></font>
                        </div>
                    </td>
                </tr>

                <!-- build_setting_cache_resources -->
                <tr>
                    <th>
                        Cache tài nguyên PHP </th>
                    <td>
                        <input type="hidden" name="_settings-enroll[]" value="cache-resources">
                        <div class="litespeed-switch"><input type="radio" autocomplete="off"
                                name="cache-resources" id="input_radio_cacheresources_0" value="0"> <label
                                for="input_radio_cacheresources_0">TẮT</label><input type="radio"
                                autocomplete="off" name="cache-resources" id="input_radio_cacheresources_1"
                                value="1" checked=""> <label for="input_radio_cacheresources_1">BẬT</label>
                        </div>
                        <div class="litespeed-desc">
                            Một số theme và plugin sẽ thêm tài nguyên thông qua một yêu cầu PHP. Cache các trang này có
                            thể cải thiện hiệu suất máy chủ bằng cách tránh các lệnh gọi PHP không cần thiết. <br>
                            <font class="litespeed-primary">⚠️ Cài đặt này sẽ chỉnh sửa tập tin .htaccess. <a
                                    href="https://docs.litespeedtech.com/lscache/lscwp/toolbox/#edit-htaccess-tab"
                                    target="_blank" class="litespeed-learn-more">Tìm hiểu thêm</a></font>
                        </div>
                    </td>
                </tr>

                <!-- build_setting_mobile_view start -->
                <tr>
                    <th>
                        Cache Mobile </th>
                    <td>
                        <input type="hidden" name="_settings-enroll[]" value="cache-mobile">
                        <div class="litespeed-switch"><input type="radio" autocomplete="off" name="cache-mobile"
                                id="input_radio_cachemobile_0" value="0" checked=""> <label
                                for="input_radio_cachemobile_0">TẮT</label><input type="radio" autocomplete="off"
                                name="cache-mobile" id="input_radio_cachemobile_1" value="1"> <label
                                for="input_radio_cachemobile_1">BẬT</label></div>
                        <div class="litespeed-desc">
                            Serve a separate cache copy for mobile visitors. <a
                                href="https://docs.litespeedtech.com/lscache/lscwp/cache/#cache-mobile"
                                target="_blank" class="litespeed-learn-more">Learn more about when this is needed</a>
                            <br>
                            <font class="litespeed-primary">⚠️ Cài đặt này sẽ chỉnh sửa tập tin .htaccess. <a
                                    href="https://docs.litespeedtech.com/lscache/lscwp/toolbox/#edit-htaccess-tab"
                                    target="_blank" class="litespeed-learn-more">Tìm hiểu thêm</a></font> <br>
                            <font class="litespeed-primary">⚠️ This setting will regenerate crawler list and clear the
                                disabled list!</font>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th class="litespeed-padding-left">
                        Danh sách Mobile User Agents </th>
                    <td>

                        <div class="litespeed-textarea-recommended">
                            <div>
                                <input type="hidden" name="_settings-enroll[]" value="cache-mobile_rules">
                                <textarea name="cache-mobile_rules" rows="5" cols="40"></textarea>
                            </div>
                            <div>
                                <div class="litespeed-desc">Giá trị mặc định:</div>
                                <textarea readonly="" rows="8" cols="30">Mobile
        Android
        Silk/
        Kindle
        BlackBerry
        Opera Mini
        Opera Mobi</textarea>
                            </div>
                        </div>

                        <div class="litespeed-desc">
                            Một trên mỗi dòng.

                        </div>
                    </td>
                </tr>
                <!-- build_setting_mobile_view end -->
                <tr>
                    <th>
                        URI được lưu trong bộ nhớ cache riêng tư </th>
                    <td>
                        <input type="hidden" name="_settings-enroll[]" value="cache-priv_uri">
                        <textarea name="cache-priv_uri" rows="5" cols="80"></textarea>
                        <div class="litespeed-desc">
                            Đường dẫn URI chứa các chuỗi này sẽ KHÔNG được lưu vào bộ nhớ cache dưới dạng công khai. Các
                            URL sẽ được so sánh với biến máy chủ REQUEST_URI. Ví dụ, đối với
                            <code>/mypath/mypage?aa=bb</code>, <code>mypage?aa=</code> có thể được sử dụng ở
                            đây.<br><i>Để khớp với phần đầu, hãy thêm <code>^</code> vào đầu mục. Để thực hiện kết hợp
                                chính xác, hãy thêm <code>$</code> vào cuối URL. Một trên mỗi dòng.</i> </div>
                    </td>
                </tr>

                <tr>
                    <th>
                        Bắt buộc cache URIs </th>
                    <td>
                        <input type="hidden" name="_settings-enroll[]" value="cache-force_uri">
                        <textarea name="cache-force_uri" rows="5" cols="80"></textarea>
                        <div class="litespeed-desc">
                            Các đường dẫn chứa các chuỗi này sẽ được lưu trữ mặc dù không có thiết lập cache. Các URL sẽ
                            được so sánh với biến máy chủ REQUEST_URI. Ví dụ, đối với <code>/mypath/mypage?aa=bb</code>,
                            <code>mypage?aa=</code> có thể được sử dụng ở đây.<br><i>Để khớp với phần đầu, hãy thêm
                                <code>^</code> vào đầu mục. Để thực hiện kết hợp chính xác, hãy thêm <code>$</code> vào
                                cuối URL. Một trên mỗi dòng.</i> <br>Để xác định một TTL tùy chỉnh cho một URI, hãy thêm
                            một khoảng trắng theo sau là giá trị TTL vào cuối URI. Ví dụ, <code>/mypath/mypage
                                300</code> định nghĩa một TTL là 300 giây cho <code>/mypath/mypage</code>. Một trên mỗi
                            dòng. </div>
                    </td>
                </tr>

                <tr>
                    <th>
                        Buộc URI bộ nhớ đệm công khai </th>
                    <td>
                        <input type="hidden" name="_settings-enroll[]" value="cache-force_pub_uri">
                        <textarea name="cache-force_pub_uri" rows="5" cols="80"></textarea>
                        <div class="litespeed-desc">
                            Các đường dẫn chứa các chuỗi này sẽ bị buộc phải lưu vào bộ nhớ cache công khai bất kể cài
                            đặt không có bộ nhớ cache. Các URL sẽ được so sánh với biến máy chủ REQUEST_URI. Ví dụ, đối
                            với <code>/mypath/mypage?aa=bb</code>, <code>mypage?aa=</code> có thể được sử dụng ở
                            đây.<br><i>Để khớp với phần đầu, hãy thêm <code>^</code> vào đầu mục. Để thực hiện kết hợp
                                chính xác, hãy thêm <code>$</code> vào cuối URL. Một trên mỗi dòng.</i> <br>Để xác định
                            một TTL tùy chỉnh cho một URI, hãy thêm một khoảng trắng theo sau là giá trị TTL vào cuối
                            URI. Ví dụ, <code>/mypath/mypage 300</code> định nghĩa một TTL là 300 giây cho
                            <code>/mypath/mypage</code>. Một trên mỗi dòng. </div>
                    </td>
                </tr>


                <tr>
                    <th>
                        Loại bỏ chuỗi truy vấn </th>
                    <td>
                        <input type="hidden" name="_settings-enroll[]" value="cache-drop_qs">
                        <textarea name="cache-drop_qs" rows="5" cols="40">fbclid
        gclid
        utm*
        _ga</textarea>
                        <div class="litespeed-desc">
                            Bỏ qua các chuỗi truy vấn nhất định khi caching. (Yêu cầu LSWS v5.2.3+) Ví dụ, để các tham
                            số bắt đầu bằng <code>utm</code>, <code>utm*</code> có thể được sử dụng ở đây. <a
                                href="https://docs.litespeedtech.com/lscache/lscwp/cache/#drop-query-string"
                                target="_blank" class="litespeed-learn-more">Tìm hiểu thêm</a>
                            <br>
                            Một trên mỗi dòng.
                            <br>
                            <font class="litespeed-primary">⚠️ Cài đặt này sẽ chỉnh sửa tập tin .htaccess. <a
                                    href="https://docs.litespeedtech.com/lscache/lscwp/toolbox/#edit-htaccess-tab"
                                    target="_blank" class="litespeed-learn-more">Tìm hiểu thêm</a></font>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>

</x-tenapp-layout>
