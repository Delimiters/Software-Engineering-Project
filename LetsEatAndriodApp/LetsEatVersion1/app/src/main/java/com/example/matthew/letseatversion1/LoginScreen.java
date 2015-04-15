package com.example.matthew.letseatversion1;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.HttpStatus;
import org.apache.http.NameValuePair;
import org.apache.http.StatusLine;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.protocol.HTTP;
import org.apache.http.client.*;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.os.AsyncTask;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.content.Intent;
import android.view.View;
import android.widget.EditText;

import java.io.BufferedReader;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Hashtable;
import java.util.List;



/**
 * A login screen that offers login via email/password.
 */
public class LoginScreen extends ActionBarActivity {

    public final static String EXTRA_MESSAGE = "com.mycompany.myfirstapp.MESSAGE";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login_screen);
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_account_creation_screen, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }


    String loginFromUser;
    String passwordFromUser;
    /** Called when the user clicks the Send button */
    public void loginButtonClick(View view) {


        EditText editTextEmail = (EditText)findViewById(R.id.email);
        EditText editTextPassword = (EditText)findViewById(R.id.password);

        loginFromUser = editTextEmail.getText().toString();
        passwordFromUser = editTextPassword.getText().toString();

        new HttpRequest().execute("http://www.csce.uark.edu/~mrs018/Login.php");
    }


    public void startCreatingAccountButtonClick(View view) {
        Intent intent = new Intent(this, accountCreationScreen.class);
        startActivity(intent);
    }



       /* new AlertDialog.Builder(this)

                .setTitle("response from server")
                .setMessage(responseFromServer)
                .setIcon(android.R.drawable.ic_dialog_alert).show();*/

Context context = this;


class HttpRequest extends AsyncTask<String,String,String>
{
    String username;
    String password;

    @Override
    protected void onPostExecute(String result) {
        // TODO Auto-generated method stub
        super.onPostExecute(result);

        if(result.equalsIgnoreCase("Please fill out all form entries") == true) {
            new AlertDialog.Builder(context).setTitle("response from server")
                       .setMessage(result)
                       .setIcon(android.R.drawable.ic_dialog_alert).show();
        }
        else if(result.equalsIgnoreCase("Username or Password Incorrect") == true){
            new AlertDialog.Builder(context).setTitle("response from server")
                       .setMessage(result)
                       .setIcon(android.R.drawable.ic_dialog_alert).show();
        }
        else{
            Intent intent = new Intent(context, UserAccountScreen.class);
            startActivity(intent);
        }

    }

    @Override
    protected void onPreExecute() {
        // TODO Auto-generated method stub
        username = loginFromUser;
        password = passwordFromUser;
        super.onPreExecute();
    }

    @Override
    protected String doInBackground(String... params) {
        try
        {
            ArrayList<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>();
            nameValuePairs.add(new BasicNameValuePair("username", username));
            nameValuePairs.add(new BasicNameValuePair("password", password));
            HttpClient httpclient = new DefaultHttpClient();
            HttpPost method = new HttpPost(params[0]);
            method.setEntity(new UrlEncodedFormEntity(nameValuePairs));

            HttpResponse response = httpclient.execute(method);
            HttpEntity entity = response.getEntity();
            if(entity != null){
                return EntityUtils.toString(entity);
            }
            else{
                return "No string.";
            }
        }
        catch(Exception e){
            return "Network problem";
        }

    }
}

}