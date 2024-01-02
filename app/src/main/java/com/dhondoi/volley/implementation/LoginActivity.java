package com.dhondoi.volley.implementation;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends AppCompatActivity {

    private TextView statusLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        statusLogin = findViewById(R.id.statusLogin);
        // url api
        final String URL = "http://192.168.1.13/api/toko-berada.php";
        // parameter key yang dan value
        Map<String, String> params = new HashMap<>();
        /*
         *
         * */
        params.put("username", "admin");
        params.put("password", "admin");
        params.put("code", "login");
        Volley.newRequestQueue(this)
                .add(new StringRequest(
                        Request.Method.POST,
                        URL,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                String text = "-";
                                try {
                                    if (new JSONObject(response).getInt("success") == 1) {
                                        text = "Login Berhasil";
                                    } else {
                                        text = "Login Gagal";
                                    }
                                } catch (JSONException e) {
//                                    text = e.getMessage();
                                    Log.e(getClass().getSimpleName(), "onResponse: ", e);
                                }
                                statusLogin.setText(text);
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
//                                statusLogin.setText(error.getMessage());
                                Log.e(getClass().getSimpleName(), "onErrorResponse: ", error);
                            }
                        }) {
                    @Override
                    protected Map<String, String> getParams() {
                        return params;
                    }
                });
    }
}