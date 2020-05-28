package com.example.androidproekt;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedWriter;
import java.io.IOException;
import java.io.OutputStreamWriter;
import java.io.Writer;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class firstStart extends AppCompatActivity {
    private EditText firstName;
    private EditText lastName;
    private EditText SSID;
    private Button insert;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_first_start);
        Log.e("ONCREATE", "On create method of firstStart initiated!");
        firstName = findViewById(R.id.firstname_field);
        lastName = findViewById(R.id.lastname_field);
        SSID = findViewById(R.id.ssid_field);
        insert = findViewById(R.id.insert_button);

        firstName.addTextChangedListener(inputControl);
        lastName.addTextChangedListener(inputControl);
        SSID.addTextChangedListener(inputControl);

        final String firstname = firstName.getText().toString().trim();
        final String lastname = lastName.getText().toString().trim();
        try {
            final int ssid = Integer.parseInt(SSID.getText().toString().trim());
            insert.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Log.e("Onclick", "On click method initiated!");
                    SharedPreferences spref = PreferenceManager.getDefaultSharedPreferences(getApplicationContext());
                    SharedPreferences.Editor preferencesEditor = spref.edit();
                    preferencesEditor.putInt("ssid", ssid);
                    preferencesEditor.putString("firstName", firstname);
                    preferencesEditor.putString("lastName", lastname);
                    preferencesEditor.apply();
                    startThread(firstname, lastname, ssid);
                }
            });
        }catch(NumberFormatException ex)
        {
            Log.e("ParseTag", "Error: " + ex.getMessage());
        }
    }

    private void startThread(final String firstname, final String lastname, final int ssid)
    {
       new Thread(new Runnable() {
           @Override
           public void run() {
               Log.e("ThreadStart", "Thread has been opened!");
               ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
               NetworkInfo activeNetwork = cm.getActiveNetworkInfo();
               if(activeNetwork != null && activeNetwork.isConnected())
               {
                   Log.e("Network", "There is network!");
                   try {
                       URL apiUrl = new URL("http://192.168.1.104:8080/PHP_API/api/user/create.php");
                       Log.e("URL", "URL HAS BEEN PARSED!");
                       HttpURLConnection conn = (HttpURLConnection) apiUrl.openConnection();
                       Log.e("Connection", "Connection has been made!");
                       conn.setDoOutput(true);
                       conn.setRequestMethod("POST");
                       conn.setRequestProperty("Content-Type", "application/json");
                       conn.setRequestProperty("Accept", "application/json");
                       JSONObject data = new JSONObject();
                       data.put("firstname", firstname);
                       data.put("lastname", lastname);
                       data.put("ssid", ssid);
                       Log.e("JSON", "Json object is made!");
                       String toWrite = String.valueOf(data);
                       Writer writer = new BufferedWriter(new OutputStreamWriter(conn.getOutputStream(), "UTF-8"));
                       writer.write(toWrite);
                       writer.close();
                       Log.e("writer", "JSON DATA HAS BEEN WRITTEN!");
                   } catch (MalformedURLException e) {
                       Log.e("MalformedURLException", "Error: " + e.getMessage());
                   } catch (IOException e) {
                       Log.e("IOException", "Error: " + e.getMessage());
                   } catch (JSONException e) {
                       Log.e("JSONException", "Error: " + e.getMessage());
                   } catch(Exception e) {
                       Log.e("DefaultException", "Error: " + e.getMessage());
                   }
               }
               else {
                   Log.e("Network", "NO NETWORK!");
               }
           }
       }).start();
    }


    private TextWatcher inputControl = new TextWatcher() {
        @Override
        public void beforeTextChanged(CharSequence s, int start, int count, int after) {

        }

        @Override
        public void onTextChanged(CharSequence s, int start, int before, int count) {
            String firstname = firstName.getText().toString().trim();
            String lastname = lastName.getText().toString().trim();
            String ssid = SSID.getText().toString().trim();
            insert.setEnabled((!firstname.isEmpty()) && (!lastname.isEmpty()) && (!ssid.isEmpty()));
        }

        @Override
        public void afterTextChanged(Editable s) {

        }
    };
}
